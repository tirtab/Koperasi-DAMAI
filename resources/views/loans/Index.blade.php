@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>List Pinjaman</h2>
            </div>
            <div class="pull-right">
                @can('loan-create')
                    <a class="btn btn-success btn-sm mb-2" href="{{ route('loans.create') }}"><i class="fa fa-plus"></i> Tambah
                        Data </a>
                @endcan
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover table-striped table-responsive">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Nasabah</th>
                <th>Nama Nasabah</th>
                <th>Jumlah Pinjaman</th>
                <th>Tanggal Pengajuan</th>
                <th>Tanggal Cair</th>
                <th>Tenor</th>
                <th>Jumlah Angsuran</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($loans as $loan)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ optional($loan->user)->code ?? 'N/A' }}</td>
                    <td>{{ optional($loan->user)->name ?? 'N/A' }}</td>
                    <td><span>Rp.</span>{{ $loan->amount }}</td>
                    <td>{{ $loan->Tgl_Pengajuan }}</td>
                    <td>{{ $loan->Tgl_Cair }}</td>
                    <td>{{ $loan->Tenor }} <strong> Tahun</strong> </td>
                    <td><span>Rp.</span>{{ $loan->jml_angsuran }}<strong> / Bulan</strong></td>
                    <td>{{ $loan->stat_loan }}</td>
                    <td>
                        @role('Admin')
                        <form action="{{ route('loans.destroy', $loan->id) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('loans.show', $loan->user->id) }}"><i
                                    class="fa-solid fa-list"></i> Lihat </a>
                            @can('loan-edit')
                                <a class="btn btn-primary btn-sm" href="{{ route('loans.edit', $loan->id) }}"><i
                                        class="fa-solid fa-pen-to-square"></i> Edit</a>
                            @endcan

                            @csrf
                            @method('DELETE')

                            @can('loan-delete')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                                    Hapus</button>
                            @endcan
                        </form>
                        @endrole

                        @role('Anggota')
                        <form action="{{ route('loans.destroy', $loan->id) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('loans.show', $loan->user->id) }}"><i
                                    class="fa-solid fa-list"></i> Lihat </a>
                        </form>
                        @endrole

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $loans->links() !!}

    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
