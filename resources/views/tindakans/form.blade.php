@extends('layouts.app')

@section('title', isset($tindakan) ? 'Edit Tindakan' : 'Tambah Tindakan')

@section('content')
<div class="mb-4">
    <h1>{{ isset($tindakan) ? 'Edit Tindakan' : 'Tambah Tindakan' }}</h1>
    <p class="text-muted">Isi data tindakan dengan lengkap.</p>
</div>

    <form action="{{ isset($tindakan) ? route('tindakans.update', $tindakan->kd_tindakan) : route('tindakans.store') }}" method="POST">
        @csrf
        @if (isset($tindakan))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nm_tindakan" class="form-label">Nama Tindakan</label>
            <input type="text" name="nm_tindakan" id="nm_tindakan" class="form-control" value="{{ old('nm_tindakan', $tindakan->nm_tindakan ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="ket" class="form-label">Keterangan</label>
            <textarea name="ket" id="ket" class="form-control" rows="4">{{ old('ket', $tindakan->ket ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($tindakan) ? 'Update' : 'Simpan' }}</button>
    </form>

@endsection
