@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tambah Angsuran</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm" href="{{ route('loans.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('installments.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Anggota:</strong>
                    <select name="loans_id" class="form-select">
                        @foreach ($loans as $loan)
                            <option value="{{ $loan->id }}">{{ $loan->user->code . ' - ' . $loan->user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Angsuran:</strong>
                    <input type="date" name="tgl_angsuran" class="form-control" placeholder="Tanggal Angsuran" value="{{ \Carbon\Carbon::now()->toDateString() }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Angsuran Ke:</strong>
                    <input type="number" name="angsuranKe" class="form-control" placeholder="Angsuran Ke">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah Angsuran:</strong>
                    <input type="number" name="amount" class="form-control" placeholder="Jumlah Angsuran">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-sm mb-3 mt-2"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            </div>
        </div>
    </form>
@endsection
