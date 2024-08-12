@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Nasabah</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('loans.index') }}">Kembali</a>
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
                <strong>Total Pinjaman:</strong>
                <span>Rp.</span>{{ $loans->where('stat_loan', '!=', 'Lunas')->sum('amount') }}
                @if ($loans->where('stat_loan', '!=', 'Lunas')->count() == 0)
                    <label class="badge bg-success">Lunas</label>
                @endif
            </div>
        </div>
    </div>

    <div class="MB-2">
        <h1>Riwayat Pinjaman</h1>
        <table class="table table-bordered table-hover table-striped table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Cair</th>
                    <th>Jumlah</th>
                    <th>Tanggal Lunas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $loan->Tgl_Pengajuan }}</td>
                        <td>{{ $loan->Tgl_Cair }}</td>
                        <td>
                            <span>Rp.</span>{{ $loan->amount }}
                            @if($loan->stat_loan == 'Lunas')
                                <label class="badge bg-success ms-2">Lunas</label>
                            @endif
                        </td>
                        <td>{{ $loan->tgl_lunas ?? 'Belum Lunas' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
