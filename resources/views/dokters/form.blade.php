@extends('layouts.app')

@section('title', isset($dokter) ? 'Edit Dokter' : 'Tambah Dokter')

@section('content')
@if(in_array(session('role'), ['admin', 'dokter']))
<h1>{{ isset($dokter) ? 'Edit Dokter' : 'Tambah Dokter' }}</h1>

<form action="{{ isset($dokter) ? route('dokters.update', $dokter->kd_dokter) : route('dokters.store') }}" method="POST">
    @csrf
    @if (isset($dokter))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nm_dokter" class="form-label">Nama Dokter</label>
        <input type="text" name="nm_dokter" id="nm_dokter" class="form-control @error('nm_dokter') is-invalid @enderror"
               value="{{ old('nm_dokter', $dokter->nm_dokter ?? '') }}" required>
        @error('nm_dokter')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="kd_poli" class="form-label">Nama Poli</label>
        <select name="kd_poli" id="kd_poli" class="form-control @error('kd_poli') is-invalid @enderror" required>
            @foreach ($polikliniks as $poliklinik)
            <option value="{{ $poliklinik->kd_poli }}" {{ old('kd_poli', $dokter->kd_poli ?? '') == $poliklinik->kd_poli ? 'selected' : '' }}>
                {{ $poliklinik->nm_poli }}
            </option>
            @endforeach
        </select>
        @error('kd_poli')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="kd_user" class="form-label">User</label>
        <select name="kd_user" id="kd_user" class="form-control @error('kd_user') is-invalid @enderror" required>
            @foreach ($users as $user)
            <option value="{{ $user->kd_user }}" {{ old('kd_user', $dokter->kd_user ?? '') == $user->kd_user ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
            @endforeach
        </select>
        @error('kd_user')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="SIP" class="form-label">SIP</label>
        <input type="text" name="SIP" id="SIP" class="form-control @error('SIP') is-invalid @enderror"
               value="{{ old('SIP', $dokter->SIP ?? '') }}" required>
        @error('SIP')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="tgl_kunjungan" class="form-label">Tanggal Kunjungan</label>
        <input type="date" name="tgl_kunjungan" id="tgl_kunjungan" class="form-control @error('tgl_kunjungan') is-invalid @enderror"
               value="{{ old('tgl_kunjungan', $dokter->tgl_kunjungan ?? '') }}" required>
        @error('tgl_kunjungan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="tmpat_lhr" class="form-label">Tempat Lahir</label>
        <input type="text" name="tmpat_lhr" id="tmpat_lhr" class="form-control @error('tmpat_lhr') is-invalid @enderror"
               value="{{ old('tmpat_lhr', $dokter->tmpat_lhr ?? '') }}" required>
        @error('tmpat_lhr')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="no_tlp" class="form-label">Nomor Telepon</label>
        <input type="text" name="no_tlp" id="no_tlp" class="form-control @error('no_tlp') is-invalid @enderror"
               value="{{ old('no_tlp', $dokter->no_tlp ?? '') }}" required>
        @error('no_tlp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" required>{{ old('alamat', $dokter->alamat ?? '') }}</textarea>
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($dokter) ? 'Update' : 'Simpan' }}</button>
</form>
@else
    <p class="text-danger">Anda tidak memiliki akses untuk halaman ini.</p>
@endif
@endsection