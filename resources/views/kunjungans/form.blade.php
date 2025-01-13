@extends('layouts.app')

@section('title', isset($kunjungan) ? 'Edit Kunjungan' : 'Tambah Kunjungan')

@section('content')
<div class="mb-4">
    <h1>{{ isset($kunjungan) ? 'Edit Kunjungan' : 'Tambah Kunjungan' }}</h1>
    <p class="text-muted">Isi data kunjungan pasien dengan lengkap.</p>
</div>

    <form action="{{ isset($kunjungan) ? route('kunjungans.update', $kunjungan->id_kunjungan) : route('kunjungans.store') }}" method="POST">
        @csrf
        @if (isset($kunjungan))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="no_pasien" class="form-label">Nama Pasien</label>
            <select name="no_pasien" id="no_pasien" class="form-control" required>
                @foreach ($pasiens as $pasien)
                <option value="{{ $pasien->no_pasien }}" {{ old('no_pasien', $kunjungan->no_pasien ?? '') == $pasien->no_pasien ? 'selected' : '' }}>
                    {{ $pasien->nm_pasien }}
                </option>
                @endforeach
            </select>

        </div>
        <div class="mb-3">
            <label for="kd_poli" class="form-label">Nama Poli</label>
            <select name="kd_poli" id="kd-poli" class="form-control" required>
                @foreach ($polikliniks as $poliklinik)
                <option value="{{ $poliklinik->kd_poli }}" {{ old('kd_poli', $kunjungan->kd_poli ?? '') == $poliklinik->kd_poli ? 'selected' : '' }}>
                    {{ $poliklinik->nm_poli }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tgl_kunjungan" class="form-label">Tanggal Kunjungan</label>
            <input type="date" name="tgl_kunjungan" id="tgl_kunjungan" class="form-control" value="{{ old('tgl_kunjungan', $kunjungan->tgl_kunjungan ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="jam_kunjungan" class="form-label">Jam Kunjungan</label>
            <input type="time" name="jam_kunjungan" id="jam_kunjungan" class="form-control" value="{{ old('jam_kunjungan', $kunjungan->jam_kunjungan ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($kunjungan) ? 'Update' : 'Simpan' }}</button>
    </form>

@endsection
