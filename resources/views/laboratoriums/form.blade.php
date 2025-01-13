@extends('layouts.app')

@section('title', isset($laboratorium) ? 'Edit Laboratorium' : 'Tambah Laboratorium')

@section('content')
<div class="mb-4">
    <h1>{{ isset($laboratorium) ? 'Edit Laboratorium' : 'Tambah Laboratorium' }}</h1>
    <p class="text-muted">Isi data hasil laboratorium pasien dengan lengkap.</p>
</div>

<form action="{{ isset($laboratorium) ? route('laboratoriums.update', $laboratorium->kd_lab) : route('laboratoriums.store') }}" method="POST">
    @csrf
    @if (isset($laboratorium))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="no_rm" class="form-label">Rekam Medis</label>
        <select name="no_rm" id="no_rm" class="form-control @error('no_rm') is-invalid @enderror" required>
            @foreach ($rekamMedis as $rekam)
            <option value="{{ $rekam->no_rm }}" {{ old('no_rm', $laboratorium->no_rm ?? '') == $rekam->no_rm ? 'selected' : '' }}>
                {{ $rekam->nama_pasien }} - {{ $rekam->no_rm }}
            </option>
            @endforeach
        </select>
        @error('no_rm')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="hasil_lab" class="form-label">Hasil Lab</label>
        <input type="text" name="hasil_lab" id="hasil_lab" class="form-control @error('hasil_lab') is-invalid @enderror"
               value="{{ old('hasil_lab', $laboratorium->hasil_lab ?? '') }}" required>
        @error('hasil_lab')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="ket" class="form-label">Keterangan</label>
        <textarea name="ket" id="ket" class="form-control @error('ket') is-invalid @enderror">{{ old('ket', $laboratorium->ket ?? '') }}</textarea>
        @error('ket')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($laboratorium) ? 'Update' : 'Simpan' }}</button>
</form>
@endsection