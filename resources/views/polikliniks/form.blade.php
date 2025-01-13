@extends('layouts.app')

@section('title', isset($poliklinik) ? 'Edit Poliklinik' : 'Tambah Poliklinik')

@section('content')
<div class="mb-4">
    <h1>{{ isset($poliklinik) ? 'Edit Poliklinik' : 'Tambah Poliklinik' }}</h1>
    <p class="text-muted">Isi data poliklinik dengan benar.</p>
</div>


    <form action="{{ isset($poliklinik) ? route('polikliniks.update', $poliklinik->kd_poli) : route('polikliniks.store') }}" method="POST">
        @csrf
        @if (isset($poliklinik))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nm_poli" class="form-label">Nama Poliklinik</label>
            <input type="text" name="nm_poli" id="nm_poli" class="form-control" value="{{ old('nm_poli', $poliklinik->nm_poli ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="lantai" class="form-label">Lantai</label>
            <input type="number" name="lantai" id="lantai" class="form-control" value="{{ old('lantai', $poliklinik->lantai ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($poliklinik) ? 'Update' : 'Simpan' }}</button>
    </form>

@endsection
