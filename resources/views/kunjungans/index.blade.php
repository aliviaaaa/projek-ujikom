@extends('layouts.app')

@section('title', 'Data Kunjungan')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Kunjungan</h3>
    @if(in_array(session('role'), ['admin', 'dokter']))
    <a href="{{ route('kunjungans.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Kunjungan
    </a>
    @endif
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($kunjungans->count() > 0)
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Nama Poli</th>
                <th>Tanggal Kunjungan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kunjungans as $index => $record)
            <tr>
                <td>{{ $index + 1  }}</td>
                <td class="truncate">{{ $record->pasien->nm_pasien }}</td>
                <td class="truncate">{{ $record->poliklinik->nm_poli }}</td>
                <td class="truncate">{{ $record->tgl_kunjungan }}</td>
                <td class="truncate">{{ $record->jam_kunjungan }}</td>
                <td>
                    @if(in_array(session('role'), ['admin', 'dokter', 'perawat']))
                    <button class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#detailModal" data-kunjungan="{{ json_encode($record) }}">
                        <i class="bi bi-eye"></i>
                    </button>
                    @endif
                    @if(in_array(session('role'), ['admin', 'dokter']))
                    <a href="{{ route('kunjungans.edit', $record->id_kunjungan) }}" class="btn btn-warning btn-sm mb-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    @endif
                    @if(in_array(session('role'), ['admin', 'dokter']))
                    <form action="{{ route('kunjungans.destroy', $record->id_kunjungan) }}" method="POST" class="d-inline">
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
<p class="text-center">Tidak ada data kunjungan.</p>
@endif

{{ $kunjungans->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Kunjungan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Pasien:</strong> <span id="modalNamaPasien"></span></p>
                <p><strong>Tanggal Kunjungan:</strong> <span id="modalTanggalKunjungan"></span></p>
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
            const kunjungan = JSON.parse(button.getAttribute('data-kunjungan'));

            document.getElementById('modalNamaPasien').textContent = kunjungan.nama_pasien;
            document.getElementById('modalTanggalKunjungan').textContent = kunjungan.tgl_kunjungan;
        });
    });
</script>
@endsection