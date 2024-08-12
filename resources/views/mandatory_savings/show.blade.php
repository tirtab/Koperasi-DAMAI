@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Data Nasabah </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('mandatory-saving.index') }}"> Kembali</a>
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
                <strong>Saldo Simpanan Wajib:</strong>
                <span>Rp.</span>{{ $user->mandatorySavings->sum('amount') }}
            </div>
        </div>

        <div class="MB-2">
            <h1>Riwayat Simpanan Wajib</h1>
            <table class="table table-bordered table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->mandatorySavings as $mandatorySaving)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $mandatorySaving->date }}</td>
                            <td><span>Rp.</span>{{ $mandatorySaving->amount }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
