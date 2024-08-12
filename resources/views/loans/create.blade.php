@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Pinjaman</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm" href="{{ route('loans.index') }}"><i class="fa fa-arrow-left"></i>
                    Kembali</a>
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

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nasabah:</strong>
                    <select name="customer_id" class="form-select">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->code . ' . ' . $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah Pinjaman:</strong>
                    <input type="number" name="amount" class="form-control" placeholder="Jumlah">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Pengajuan:</strong>
                    <input type="date" name="Tgl_Pengajuan" class="form-control" placeholder="Tanggal Pengajuan"
                        value="{{ \Carbon\Carbon::now('Asia/Jakarta')->toDateString() }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal cair:</strong>
                    <input type="date" name="Tgl_Cair" class="form-control" placeholder="Tanggal Cair">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tenor:</strong>
                    <input type="number" name="Tenor" class="form-control"
                        placeholder="Jangka waktu pinjaman (dalam tahun).">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah Angsuran:</strong>
                    <input type="number" name="jml_angsuran" class="form-control"
                        placeholder="Jumlah yang harus dibayar setiap periode (bulanan)">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status Pinjaman:</strong>
                    <input type="text" name="stat_loan" class="form-control" value="Dalam Proses" readonly>
                    </input>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-sm mb-3 mt-2"><i class="fa-solid fa-floppy-disk"></i>
                    Simpan</button>
            </div>
        </div>
    </form>

    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
