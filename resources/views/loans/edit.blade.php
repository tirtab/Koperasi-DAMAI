@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Pinjaman</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary btn-sm mb-2" href="{{ route('loans.index') }}"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('loans.update', $loan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nasabah:</strong>
                    <select name="customer_id" class="form-select">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $loan->customer_id == $user->id ? 'selected' : '' }}>
                                {{ $user->code . ' . ' . $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('customer_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah Pinjaman:</strong>
                    <input type="number" name="amount" class="form-control" placeholder="Jumlah" value="{{ old('amount', $loan->amount) }}">
                    @error('amount')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Cair:</strong>
                    <input type="date" name="Tgl_Cair" class="form-control" placeholder="Tanggal Cair" value="{{ old('Tgl_Cair', $loan->Tgl_Cair) }}">
                    @error('Tgl_Cair')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tenor:</strong>
                    <input type="number" name="Tenor" class="form-control" placeholder="Jangka waktu pinjaman (dalam tahun)" value="{{ old('Tenor', $loan->Tenor) }}">
                    @error('Tenor')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah Angsuran:</strong>
                    <input type="number" name="jml_angsuran" class="form-control" placeholder="Jumlah yang harus dibayar setiap periode (bulanan)" value="{{ old('jml_angsuran', $loan->jml_angsuran) }}">
                    @error('jml_angsuran')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status Pinjaman:</strong>
                    <select name="stat_loan" class="form-select">
                        <option value="Dalam Proses" {{ old('stat_loan', $loan->stat_loan) == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses</option>
                        <option value="Disetujui" {{ old('stat_loan', $loan->stat_loan) == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Dicairkan" {{ old('stat_loan', $loan->stat_loan) == 'Dicairkan' ? 'selected' : '' }}>Dicairkan</option>
                        <option value="Lunas" {{ old('stat_loan', $loan->stat_loan) == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                    @error('stat_loan')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-sm mb-3 mt-2"><i class="fa-solid fa-floppy-disk"></i> Ubah</button>
            </div>
        </div>
    </form>

    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
