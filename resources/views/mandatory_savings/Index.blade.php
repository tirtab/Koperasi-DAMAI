    @extends('layouts.app')

    @section('content')
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>List Simpanan Wajib</h2>
                </div>
                <div class="pull-right">
                    @can('mandatorySavings-create')
                        <a class="btn btn-success btn-sm mb-2" href="{{ route('mandatory-saving.create') }}"><i
                                class="fa fa-plus"></i>
                            Tambah Data</a>
                    @endcan
                </div>
            </div>
        </div>

        @session('success')
            <div class="alert alert-success" role="alert">
                {{ $value }}
            </div>
        @endsession

        <table class="table table-bordered table-hover table-striped table-responsive">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode Nasabah</th>
                <th>Nama Nasabah</th>
                <th>Jumlah Bayar</th>
                <th>Aksi</th>
            </tr>
            @foreach ($mandatorySavings as $mandatorySaving)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td> {{ $mandatorySaving->date }} </td>
                    <td> {{ optional($mandatorySaving->user)->code ?? 'N/A' }} </td>
                    <td> {{ optional($mandatorySaving->user)->name ?? 'N/A' }} </td>
                    <td> {{ 'Rp. '. $mandatorySaving->amount }} </td>
                    <td>
                        @role('Admin')
                            <form action="{{ route('mandatory-saving.destroy', $mandatorySaving->id) }}" method="POST">
                                <a class="btn btn-info btn-sm"
                                    href="{{ route('mandatory-saving.show', $mandatorySaving->user->id) }}"><i
                                        class="fa-solid fa-list"></i> Lihat</a>
                                @can('mandatorySavings-edit')
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('mandatory-saving.edit', $mandatorySaving->id) }}"><i
                                            class="fa-solid fa-pen-to-square"></i> Edit</a>
                                @endcan

                                @csrf
                                @method('DELETE')

                                @can('mandatorySavings-delete')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                                        Hapus</button>
                                @endcan
                            </form>
                        @endrole

                        @role('Anggota')
                            <form action="{{ route('mandatory-saving.destroy', $mandatorySaving->id) }}" method="POST">
                                <a class="btn btn-info btn-sm"
                                    href="{{ route('mandatory-saving.show', $mandatorySaving->user->id) }}"><i
                                        class="fa-solid fa-list"></i> Lihat</a>

                            </form>
                        @endrole
                    </td>
                </tr>
            @endforeach
        </table>

        {!! $mandatorySavings->links() !!}

        <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
    @endsection
