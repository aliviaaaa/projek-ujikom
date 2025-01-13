@extends('layouts.app')

@section('title', isset($obat) ? 'Edit Obat' : 'Tambah Obat')

@section('content')
<div class="mb-4">
    <h1>{{ isset($obat) ? 'Edit Obat' : 'Tambah Obat' }}</h1>
    <p class="text-muted">Isi data obat dengan lengkap.</p>
</div>

    <form action="{{ isset($obat) ? route('obats.update', $obat->kd_obat) : route('obats.store') }}" method="POST">
        @csrf
        @if (isset($obat))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nm_obat" class="form-label">Nama Obat</label>
            <input type="text" name="nm_obat" id="nm_obat" class="form-control" value="{{ old('nm_obat', $obat->nm_obat ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="jml_obat" class="form-label">Jumlah Obat</label>
            <input type="number" name="jml_obat" id="jml_obat" class="form-control" value="{{ old('jml_obat', $obat->jml_obat ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="ukuran" class="form-label">Ukuran</label>
            <input type="text" name="ukuran" id="ukuran" class="form-control" value="{{ old('ukuran', $obat->ukuran ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" name="harga" id="harga" class="form-control" step="0.01" value="{{ old('harga', $obat->harga ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($obat) ? 'Update' : 'Simpan' }}</button>
    </form>
@endsection
