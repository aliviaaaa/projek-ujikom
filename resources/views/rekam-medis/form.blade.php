@extends('layouts.app')

@section('title', isset($rekamMedis) ? 'Edit Rekam Medis' : 'Tambah Rekam Medis')

@section('content')
@if(in_array(session('role'), ['admin', 'dokter', 'perawat']))
<div class="mb-4">
    <h1>{{ isset($rekamMedis) ? 'Edit Rekam Medis' : 'Tambah Rekam Medis' }}</h1>
    <p class="text-muted">Isi data rekam medis pasien.</p>
    <form action="{{ isset($rekamMedis) ? route('rekam-medis.update', $rekamMedis->no_rm) : route('rekam-medis.store') }}" method="POST">
        @csrf
        @if (isset($rekamMedis))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="no_pasien" class="form-label">Pasien</label>
            <select name="no_pasien" id="no_pasien" class="form-control" required>
                @foreach ($pasiens as $pasien)
                <option value="{{ $pasien->no_pasien }}" {{ old('no_pasien', $rekamMedis->no_pasien ?? '') == $pasien->no_pasien ? 'selected' : '' }}>
                    {{ $pasien->nm_pasien }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="kd_tindakan" class="form-label">Tindakan</label>
            <select name="kd_tindakan" id="kd_tindakan" class="form-control" required>
                @foreach ($tindakans as $tindakan)
                <option value="{{ $tindakan->kd_tindakan }}" {{ old('kd_tindakan', $rekamMedis->kd_tindakan ?? '') == $tindakan->kd_tindakan ? 'selected' : '' }}>
                    {{ $tindakan->nm_tindakan }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="kd_obat" class="form-label">Obat</label>
            <select name="kd_obat" id="kd_obat" class="form-control" required>
                @foreach ($obats as $obat)
                <option value="{{ $obat->kd_obat }}" {{ old('kd_obat', $rekamMedis->kd_obat ?? '') == $obat->kd_obat ? 'selected' : '' }}>
                    {{ $obat->nm_obat }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="diagnosa" class="form-label">Diagnosa</label>
            <input type="text" name="diagnosa" id="diagnosa" class="form-control" value="{{ old('diagnosa', $rekamMedis->diagnosa ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="resep" class="form-label">Resep</label>
            <textarea name="resep" id="resep" class="form-control" rows="4" required>{{ old('resep', $rekamMedis->resep ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <textarea name="keluhan" id="keluhan" class="form-control" rows="4" required>{{ old('keluhan', $rekamMedis->keluhan ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tgl_pemeriksaan" class="form-label">Tanggal Pemeriksaan</label>
            <input type="date" name="tgl_pemeriksaan" id="tgl_pemeriksaan" class="form-control" value="{{ old('tgl_pemeriksaan', $rekamMedis->tgl_pemeriksaan ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="ket" class="form-label">Keterangan</label>
            <input type="text" name="ket" id="ket" class="form-control" value="{{ old('ket', $rekamMedis->ket ?? '') }}">
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($rekamMedis) ? 'Update' : 'Simpan' }}</button>
    </form>
</div>
@endif
@endsection