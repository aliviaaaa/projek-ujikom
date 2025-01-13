@extends('layouts.app')

@section('title', isset($pasien) ? 'Edit Pasien' : 'Tambah Pasien')

@section('content')
@if(in_array(session('role'), ['admin', 'dokter', 'perawat']))
<h1>{{ isset($pasien) ? 'Edit Pasien' : 'Tambah Pasien' }}</h1>

<form action="{{ isset($pasien) ? route('pasiens.update', $pasien->no_pasien) : route('pasiens.store') }}" method="POST">
    @csrf
    @if (isset($pasien))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nm_pasien" class="form-label">Nama Pasien</label>
        <input type="text" name="nm_pasien" id="nm_pasien" class="form-control @error('nm_pasien') is-invalid @enderror"
               value="{{ old('nm_pasien', $pasien->nm_pasien ?? '') }}" required>
        @error('nm_pasien')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="j_kel" class="form-label">Jenis Kelamin</label>
        <select name="j_kel" id="j_kel" class="form-control @error('j_kel') is-invalid @enderror" required>
            <option value="L" {{ old('j_kel', $pasien->j_kel ?? '') == 'L' ? 'selected' : '' }}>Laki-laki</option>
            <option value="P" {{ old('j_kel', $pasien->j_kel ?? '') == 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('j_kel')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="agama" class="form-label">Agama</label>
        <select name="agama" id="agama" class="form-control @error('agama') is-invalid @enderror" required>
            <option value="">Pilih Agama</option>
            <option value="Islam" {{ old('agama', $pasien->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
            <option value="Kristen" {{ old('agama', $pasien->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
            <option value="Hindu" {{ old('agama', $pasien->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
            <option value="Budha" {{ old('agama', $pasien->agama ?? '') == 'Budha' ? 'selected' : '' }}>Budha</option>
        </select>
        @error('agama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $pasien->alamat ?? '') }}</textarea>
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="tgl_lhr" class="form-label">Tanggal Lahir</label>
        <input type="date" name="tgl_lhr" id="tgl_lhr" class="form-control @error('tgl_lhr') is-invalid @enderror"
               value="{{ old('tgl_lhr', $pasien->tgl_lhr ?? '') }}" required>
        @error('tgl_lhr')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="usia" class="form-label">Usia</label>
        <input type="number" name="usia" id="usia" class="form-control @error('usia') is-invalid @enderror"
               value="{{ old('usia', $pasien->usia ?? '') }}" min="0" required>
        @error('usia')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="no_tlp" class="form-label">Nomor Telepon</label>
        <input type="text" name="no_tlp" id="no_tlp" class="form-control @error('no_tlp') is-invalid @enderror"
               value="{{ old('no_tlp', $pasien->no_tlp ?? '') }}" required>
        @error('no_tlp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nm_kk" class="form-label">Nama Kepala Keluarga</label>
        <input type="text" name="nm_kk" id="nm_kk" class="form-control @error('nm_kk') is-invalid @enderror"
               value="{{ old('nm_kk', $pasien->nm_kk ?? '') }}" required>
        @error('nm_kk')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="hub_kel" class="form-label">Hubungan Keluarga</label>
        <input type="text" name="hub_kel" id="hub_kel" class="form-control @error('hub_kel') is-invalid @enderror"
               value="{{ old('hub_kel', $pasien->hub_kel ?? '') }}" required>
        @error('hub_kel')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($pasien) ? 'Update' : 'Simpan' }}</button>
</form>
@else
    <p class="text-danger">Anda tidak memiliki akses untuk halaman ini.</p>
@endif
@endsection
