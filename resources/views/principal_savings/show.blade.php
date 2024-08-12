@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Data Nasabah </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('principal-saving.index') }}"> Kembali</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kode Nasabah:</strong>
                {{ $user->code }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Nasabah:</strong>
                {{ $user->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Alamat Nasabah:</strong>
                {{ $user->address }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Telepon Nasabah:</strong>
                {{ $user->phone }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Saldo Simpanan Pokok:</strong>
                <span>Rp.</span>{{ $user->principalSavings->sum('amount') }}
            </div>
        </div>

        <div class="MB-2">
            <h1>Riwayat Simpanan Pokok</h1>
            <table class="table table-bordered table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->principalSavings as $principalSaving)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $principalSaving->date }}</td>
                            <td><span>Rp.</span>{{ $principalSaving->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
