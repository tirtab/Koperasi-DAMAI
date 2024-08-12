@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Nasabah</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-pr@extends('layouts.app')

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
                                {{ $user ? $user->code : 'Tidak ditemukan' }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Nama Nasabah:</strong>
                                {{ $user ? $user->name : 'Tidak ditemukan' }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Alamat Nasabah:</strong>
                                {{ $user ? $user->address : 'Tidak ditemukan' }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Telepon Nasabah:</strong>
                                {{ $user ? $user->phone : 'Tidak ditemukan' }}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Total Pinjaman:</strong>
                                <span>Rp.</span>{{ $loan ? $loan->amount : 'Tidak ditemukan' }}
                                @if ($loan && $loan->stat_loan == 'Lunas')
                                    <label class="badge bg-success">Lunas</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="mb-2">
                        <h1>Riwayat Angsuran</h1>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Anggota</th>
                                    <th>Kode Anggota</th>
                                    <th>Tanggal Angsuran</th>
                                    <th>Angsuran Ke</th>
                                    <th>Jumlah Angsuran</th>
                                    <th width="280px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($loan && $loan->installments)
                                    @foreach ($loan->installments as $ins)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user ? $user->name : 'Tidak ditemukan' }}</td>
                                            <td>{{ $user ? $user->code : 'Tidak ditemukan' }}</td>
                                            <td>{{ $ins->tgl_angsuran }}</td>
                                            <td>{{ $ins->angsuranKe }}</td>
                                            <td>{{ $ins->amount }}</td>
                                            <td>
                                                <form action="{{ route('installments.destroy', $ins->id) }}" method="POST">
                                                    <a class="btn btn-primary btn-sm mb-1 mt-1" href="{{ route('installments.edit', $ins->id) }}"><i class="fa fa-edit"></i> Edit</a>

                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm mb-1 mt-1"><i class="fa fa-trash"></i> Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">Tidak ada data angsuran untuk pinjaman ini.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
                @endsection
                imary" href="{{ route('loans.index') }}">Kembali</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Kode Nasabah:</strong>
                {{ $user ? $user->code : 'Tidak ditemukan' }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Nasabah:</strong>
                {{ $user ? $user->name : 'Tidak ditemukan' }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Alamat Nasabah:</strong>
                {{ $user ? $user->address : 'Tidak ditemukan' }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Telepon Nasabah:</strong>
                {{ $user ? $user->phone : 'Tidak ditemukan' }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Total Pinjaman:</strong>
                <span>Rp.</span>{{ $installment->amount }}
                @if ($loan && $loan->stat_loan == 'Lunas')
                    <label class="badge bg-success">Lunas</label>
                @endif
            </div>
        </div>
    </div>
    <div class="mb-2">
        <h1>Riwayat Angsuran</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Kode Anggota</th>
                    <th>Tanggal Angsuran</th>
                    <th>Angsuran Ke</th>
                    <th>Jumlah Angsuran</th>
                    <th width="280px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($loan && $loan->installments)
                    @foreach ($loan->installments as $ins)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user ? $user->name : 'Tidak ditemukan' }}</td>
                            <td>{{ $user ? $user->code : 'Tidak ditemukan' }}</td>
                            <td>{{ $ins->tgl_angsuran }}</td>
                            <td>{{ $ins->angsuranKe }}</td>
                            <td>{{ $ins->amount }}</td>
                            <td>
                                <form action="{{ route('installments.destroy', $ins->id) }}" method="POST">
                                    <a class="btn btn-primary btn-sm mb-1 mt-1" href="{{ route('installments.edit', $ins->id) }}"><i class="fa fa-edit"></i> Edit</a>

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm mb-1 mt-1"><i class="fa fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7">Tidak ada data angsuran untuk pinjaman ini.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
