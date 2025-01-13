@extends('layouts.app')

@section('title', 'Data Rekam Medis')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="text-muted">Daftar Rekam Medis</h4>
    @if(in_array(session('role'), ['admin', 'dokter']))
    <a href="{{ route('rekam-medis.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Rekam Medis
    </a>
    @endif
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($rekamMedis->count() > 0)
<div class="table-responsive">
    <table class="table table-hover table-bordered bg-white">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Pasien</th>
                <th>Tindakan</th>
                <th>Obat</th>
                <th>Diagnosa</th>
                <th>Keluhan</th>
                <th>Tanggal Pemeriksaan</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekamMedis as $index => $record)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="truncate">{{ $record->pasien->nm_pasien }}</td>
                <td class="truncate">{{ $record->tindakan->nm_tindakan }}</td>
                <td class="truncate">{{ $record->obat->nm_obat }}</td>
                <td class="truncate">{{ $record->diagnosa }}</td>
                <td class="truncate">{{ $record->keluhan }}</td>
                <td class="truncate">{{ $record->tgl_pemeriksaan }}</td>
                <td class="truncate">{{ $record->ket }}</td>
                <td>
                    @if(in_array(session('role'), ['admin', 'dokter', 'perawat', 'farmasi', 'laboratorium','pasien']))
                    <button class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#detailModal" data-rekam-medis="{{ json_encode($record) }}">
                        <i class="bi bi-eye"></i>
                    </button>
                    @endif
                    @if(in_array(session('role'), ['admin', 'dokter']))
                    <a href="{{ route('rekam-medis.edit', $record->no_rm) }}" class="btn btn-warning btn-sm mb-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    @endif
                    @if(in_array(session('role'), ['admin', 'dokter']))
                    <form action="{{ route('rekam-medis.destroy', $record->no_rm) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Yakin ingin menghapus?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<p class="text-center">Tidak ada data rekam medis.</p>
@endif

{{ $rekamMedis->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Rekam Medis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Pasien:</strong> <span id="modalPasien"></span></p>
                <p><strong>Tindakan:</strong> <span id="modalTindakan"></span></p>
                <p><strong>Obat:</strong> <span id="modalObat"></span></p>
                <p><strong>Diagnosa:</strong> <span id="modalDiagnosa"></span></p>
                <p><strong>Keluhan:</strong> <span id="modalKeluhan"></span></p>
                <p><strong>Tanggal Pemeriksaan:</strong> <span id="modalTanggalPemeriksaan"></span></p>
                <p><strong>Keterangan:</strong> <span id="modalKeterangan"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const detailModal = document.getElementById('detailModal');
        detailModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const rekamMedis = JSON.parse(button.getAttribute('data-rekam-medis'));

            document.getElementById('modalPasien').textContent = rekamMedis.pasien.nm_pasien;
            document.getElementById('modalTindakan').textContent = rekamMedis.tindakan.nm_tindakan;
            document.getElementById('modalObat').textContent = rekamMedis.obat.nm_obat;
            document.getElementById('modalDiagnosa').textContent = rekamMedis.diagnosa;
            document.getElementById('modalKeluhan').textContent = rekamMedis.keluhan;
            document.getElementById('modalTanggalPemeriksaan').textContent = rekamMedis.tgl_pemeriksaan;
            document.getElementById('modalKeterangan').textContent = rekamMedis.ket;
        });
    });
</script>
@endsection