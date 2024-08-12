<?php

namespace App\Http\Controllers;

use App\Models\PrincipalSavings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PrincipalSavingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:principalSavings-list|principalSavings-create|principalSavings-edit|mandatorySavings-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:principalSavings-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:principalSavings-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:principalSavings-delete', ['only' => ['destroy']]);
    }

    public function index(): View
    {
        $user = Auth::user();


        if ($user->hasRole('Admin')) {
            // Jika pengguna adalah Admin, ambil semua data
            $principalSavings = PrincipalSavings::latest()->Paginate(5);
        } else {
            // Jika pengguna adalah Anggota, ambil data miliknya sendiri
            $principalSavings = PrincipalSavings::where('customer_id', $user->id)->latest()->Paginate(5);

        }

        return view('principal_savings.Index', compact('principalSavings'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create(PrincipalSavings $principalSavings): View
    {
        $users = User::whereHas('roles', function($query) {
            $query->where('name', '!=', 'Admin');
        })->get();

        return view('principal_savings.create', compact('users', 'principalSavings'));
    }

    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'customer_id' => 'required',
            'amount' => 'required|numeric|min:50000|',
        ]);

        PrincipalSavings::create($request->all());

        return redirect()->route('principal-saving.index')
            ->with('success', 'Product created successfully.');
    }

    public function show($id): View
    {
        $user = User::findOrFail($id); // Mengasumsikan ada relasi 'customer' di model 'MandatorySavings'
        $principalSaving = $user->principalSaving;

        return view('principal_savings.show', compact('principalSaving','user'));
    }

    public function edit(PrincipalSavings $principalSavings): View
    {
        $users = User::all();

        return view('principal_savings.edit', compact('principalSaving', 'users'));
    }

    public function update(Request $request, PrincipalSavings $principalSaving): RedirectResponse
    {
        request()->validate([
            'customer_id' => 'required',
            'amount' => 'required',
        ]);

        $principalSaving->update($request->all());

        return redirect()->route('principal-saving.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $principalSaving = PrincipalSavings::findOrFail($id);

        if ($principalSaving->delete()) {
            return redirect()->route('principal-saving.index')
                ->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('mandatory-saving.index')
                ->withErrors('Data Gagal Dihapus');
        }
    }
}
