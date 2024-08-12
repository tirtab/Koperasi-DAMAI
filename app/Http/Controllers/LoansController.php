<?php

namespace App\Http\Controllers;

use App\Models\loans;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoansController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:loan-list|loan-create|loan-edit|loan-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:loan-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:loan-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:loan-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            // Jika pengguna adalah Admin, ambil semua data
            $loans = Loans::orderBy('tgl_pengajuan', 'desc')->paginate(5);
        } else {
            // Jika pengguna adalah Anggota, ambil data miliknya sendiri
            $loans = Loans::where('customer_id', $user->id)->orderBy('tgl_pengajuan', 'desc')->paginate(5);

        }

        return view('loans.Index', compact('loans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        $users = User::whereHas('roles', function($query) {
            $query->where('name', '!=', 'Admin');
        })->get();

        return view('loans.create', compact('users'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'customer_id' => 'required',
            'amount' => 'required|numeric',
            'Tgl_Pengajuan' => 'required|date',
            'Tgl_Cair' => 'required|date',
            'Tenor' => 'required|integer',
            'jml_angsuran' => 'required|numeric',
            'stat_loan' => 'required',
        ]);

        // Cek status pinjaman dan set tgl_lunas jika status lunas
        if ($validatedData['stat_loan'] == 'Lunas') {
            $validatedData['tgl_lunas'] = date('Y-m-d');
        }

        Loans::create($validatedData);

        return redirect()->route('loans.index')
            ->with('success', 'Product created successfully.');
    }

    public function show($id): View
    {
        $user = User::findOrFail($id); // Ambil data customer berdasarkan ID
        $loans = $user->loans; // Ambil data loans terkait customer tersebut

        return view('loans.show', compact('loans', 'user'));
    }

    public function edit(Loans $loan): View
    {
        $users = User::all();

        return view('loans.edit', compact('loan', 'users'));
    }

    public function update(Request $request, Loans $loan): RedirectResponse
    {
        $validatedData = $request->validate([
            'customer_id' => 'sometimes|required',
            'amount' => 'sometimes|required|numeric',
            'Tgl_Pengajuan' => 'sometimes|required|date',
            'Tgl_Cair' => 'sometimes|required|date',
            'Tenor' => 'sometimes|required|integer',
            'jml_angsuran' => 'sometimes|required|numeric',
            'stat_loan' => 'sometimes|required',
        ]);

        // Cek status pinjaman dan set tgl_lunas jika status lunas
        if ($validatedData['stat_loan'] == 'Lunas' && !$loan->tgl_lunas) {
            $validatedData['tgl_lunas'] = date('Y-m-d');
        } elseif ($validatedData['stat_loan'] != 'Lunas') {
            $validatedData['tgl_lunas'] = null;
        }

        $loan->update($validatedData);

        return redirect()->route('loans.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $loans = Loans::findOrFail($id);

        if ($loans->delete()) {
            return redirect()->route('loans.index')
                ->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('loans.index')
                ->withErrors('Data Gagal Dihapus');
        }
    }
}
