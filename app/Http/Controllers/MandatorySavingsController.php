<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\MandatorySavings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class MandatorySavingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:mandatorySavings-list|mandatorySavings-create|mandatorySavings-edit|mandatorySavings-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:mandatorySavings-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:mandatorySavings-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:mandatorySavings-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $user = Auth::user();


        if ($user->hasRole('Admin')) {
            // Jika pengguna adalah Admin, ambil semua data
            $mandatorySavings = MandatorySavings::latest()->Paginate(5);
        } else {
            // Jika pengguna adalah Anggota, ambil data miliknya sendiri
            $mandatorySavings = MandatorySavings::where('customer_id', $user->id)->latest()->Paginate(5);

        }

        return view('mandatory_savings.index', compact('mandatorySavings'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(MandatorySavings $mandatorySaving): View
    {
        $users = User::whereHas('roles', function($query) {
            $query->where('name', '!=', 'Admin');
        })->get();

        return view('mandatory_savings.create', compact('users', 'mandatorySaving'));
    }

    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'customer_id' => 'required',
            'amount' => 'required|numeric|min:10000|',
        ]);

        MandatorySavings::create($request->all());

        return redirect()->route('mandatory-saving.index')
            ->with('success', 'Product created successfully.');
    }

    public function show($id): View
    {
        $user = User::findOrFail($id); // Mengasumsikan ada relasi 'customer' di model 'MandatorySavings'
        $mandatorySaving = $user->mandatorySaving;

        return view('mandatory_savings.show', compact('mandatorySaving','user'));
    }

    public function edit(MandatorySavings $mandatorySaving): View
    {
        $users = User::all();

        return view('mandatory_savings.edit', compact('mandatorySaving', 'users'));
    }

    public function update(Request $request, MandatorySavings $mandatorySaving): RedirectResponse
    {
        request()->validate([
            'customer_id' => 'required',
            'amount' => 'required',
        ]);

        $mandatorySaving->update($request->all());

        return redirect()->route('mandatory-saving.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $mandatorySaving = MandatorySavings::findOrFail($id);

        if ($mandatorySaving->delete()) {
            return redirect()->route('mandatory-saving.index')
                ->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('mandatory-saving.index')
                ->withErrors('Data Gagal Dihapus');
        }
    }
}
