@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Data Angsuran Pinjaman</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success btn-sm mb-2" href="{{ route('installments.create') }}"><i
                        class="fa-solid fa-plus"></i> Tambah Angsuran</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

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
            @foreach ($installments as $installment)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $installment->loans->user->name }}</td>
                    <td>{{ $installment->loans->user->code }}</td>
                    <td>{{ $installment->tgl_angsuran }}</td>
                    <td>{{ $installment->angsuranKe }}</td>
                    <td>{{ $installment->amount }}</td>
                    <td>
                        <form action="{{ route('installments.destroy', $installment->id) }}" method="POST">
                            <a class="btn btn-info btn-sm" href="{{ route('installments.show', $installment->id) }}"><i
                                    class="fa-solid fa-list"></i> Lihat </a>
                            @can('installment-edit')
                                <a class="btn btn-primary btn-sm mb-1 mt-1"
                                    href="{{ route('installments.edit', $installment->id) }}"><i class="fa fa-edit"></i>
                                    Edit</a>
                            @endcan

                            @csrf
                            @method('DELETE')

                            @can('installment-delete')
                                <button type="submit" class="btn btn-danger btn-sm mb-1 mt-1"><i class="fa fa-trash"></i>
                                    Hapus</button>
                            @endcan
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {!! $installments->links() !!}
@endsection
