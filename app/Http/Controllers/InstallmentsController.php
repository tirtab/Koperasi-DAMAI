<?php

namespace App\Http\Controllers;

use App\Models\Installments;
use App\Models\Loans;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class InstallmentsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            // Jika pengguna adalah Admin, ambil semua data
            $installments = Installments::with('loans.user')->orderBy('angsuranKe', 'desc')->paginate(5);
        } else {
            // Jika pengguna adalah Anggota, ambil data miliknya sendiri
            $installments = Installments::whereHas('loans', function($query) use ($user) {
                $query->where('customer_id', $user->id);
            })->with('loans.user')->orderBy('angsuranKe', 'desc')->paginate(5);
        }

        return view('installments.index', compact('installments'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', '!=', 'Admin');
        })->get();
        $loans = Loans::all();

        return view('installments.create', compact('users', 'loans'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'loans_id' => 'required',
            'amount' => 'required|numeric',
            'tgl_angsuran' => 'required|date',
            'angsuranKe' => 'required|integer',
        ]);

        $installment = Installments::create($validatedData);

        $this->updateLoanStatus($installment->loans_id);

        return redirect()->route('installments.index')
            ->with('success', 'Installment created successfully.');
    }

    public function show($id): View
    {
        $installment = Installments::with('loans.user')->findOrFail($id);
        $loan = $installment->loans;
        $user = $loan ? $loan->user : null;

        // Debugging
        // dd($installment, $loan, $user);

        return view('installments.show', compact('installment', 'loan', 'user'));
    }


    public function edit(Installments $installment): View
    {
        $loans = Loans::all();

        return view('installments.edit', compact('installment', 'loans'));
    }

    public function update(Request $request, $id)
    {
        $installments = Installments::findOrFail($id);

        $validatedData = $request->validate([
            'loans_id' => 'required',
            'amount' => 'required|numeric',
            'tgl_angsuran' => 'required|date',
            'angsuranKe' => 'required|integer',
        ]);

        $installments->update($validatedData);

        $this->updateLoanStatus($installments->loans_id);

        return redirect()->route('installments.index')
            ->with('success', 'Installment updated successfully.');
    }

    private function updateLoanStatus($loansId)
    {
        $loan = Loans::find($loansId);
        $totalPaid = Installments::where('loans_id', $loansId)->sum('amount');

        if ($totalPaid >= $loan->amount) {
            $loan->update([
                'stat_loan' => 'Lunas',
                'tgl_lunas' => now()
            ]);
        } else {
            $loan->update([
                'stat_loan' => 'Dalam Proses',
                'tgl_lunas' => null
            ]);
        }
    }

    public function destroy($id)
    {
        $installments = Installments::findOrFail($id);

        if ($installments->delete()) {
            return redirect()->route('installments.index')
                ->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('installments.index')
                ->withErrors('Data Gagal Dihapus');
        }
    }
}
