@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Angsuran</h2>
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

    <form action="{{ route('installments.update', $installment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Anggota:</strong>
                    <select name="loans_id" class="form-select">
                        @foreach ($loans as $loan)
                            <option value="{{ $loan->id }}" {{ $loan->id == $installment->loans_id ? 'selected' : '' }}>{{ $loan->user->code . ' - ' . $loan->user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tanggal Angsuran:</strong>
                    <input type="date" name="tgl_angsuran" class="form-control" value="{{ $installment->tgl_angsuran }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Angsuran Ke:</strong>
                    <input type="number" name="angsuranKe" class="form-control" value="{{ $installment->angsuranKe }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jumlah Angsuran:</strong>
                    <input type="number" name="amount" class="form-control" value="{{ $installment->amount }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-sm mb-3 mt-2"><i class="fa-solid fa-floppy-disk"></i> Update</button>
            </div>
        </div>
    </form>
@endsection
