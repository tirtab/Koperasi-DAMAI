@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Users Management</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success btn-sm mb-2" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Tambah
                    User
                    Baru</a>
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
            <th>Kode</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Roles</th>
            <th width="280px">Aksi</th>
        </tr>
        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->code }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $v)
                            <label class="badge bg-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('users.show', $user->id) }}"><i
                            class="fa-solid fa-list"></i> Lihat </a>
                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit', $user->id) }}"><i
                            class="fa-solid fa-pen-to-square"></i> Edit</a>
                    <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="display:inline">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                            Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $data->links('pagination::bootstrap-5') !!}

    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
