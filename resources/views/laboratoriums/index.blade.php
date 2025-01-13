@extends('layouts.app')

@section('title', 'Data Laboratorium')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Laboratorium</h3>
    @if(in_array(session('role'), ['admin', 'laboratorium']))
    <a href="{{ route('laboratoriums.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Hasil Laboratorium
    </a>
    @endif
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($laboratoriums->count() > 0)
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Rekam Medis</th>
                <th>Hasil Lab</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laboratoriums as $index => $laboratorium)
            <tr>
                <td>{{ $index + $laboratoriums->firstItem() }}</td>
                <td class="truncate">{{ $laboratorium->rekamMedis->no_rm}}</td>
                <td class="truncate">{{ $laboratorium->hasil_lab }}</td>
                <td class="truncate">{{ $laboratorium->ket }}</td>
                <td>
                    @if(in_array(session('role'), ['admin', 'laboratorium', 'dokter']))
                    <button class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#detailModal" data-laboratorium="{{ json_encode($laboratorium) }}">
                        <i class="bi bi-eye"></i>
                    </button>
                    @endif
                    @if(in_array(session('role'), ['admin', 'laboratorium']))
                    <a href="{{ route('laboratoriums.edit', $laboratorium->kd_lab) }}" class="btn btn-warning btn-sm mb-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    @endif
                    @if(in_array(session('role'), ['admin', 'laboratorium']))
                    <form action="{{ route('laboratoriums.destroy', $laboratorium->kd_lab) }}" method="POST" class="d-inline">
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
<p class="text-center">Tidak ada data laboratorium.</p>
@endif

{{ $laboratoriums->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Laboratorium</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Pasien:</strong> <span id="modalNamaPasien"></span></p>
                <p><strong>Nama Tes:</strong> <span id="modalNamaTes"></span></p>
                <p><strong>Tanggal Tes:</strong> <span id="modalTanggalTes"></span></p>
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
            const laboratorium = JSON.parse(button.getAttribute('data-laboratorium'));

            document.getElementById('modalNamaPasien').textContent = laboratorium.nama_pasien;
            document.getElementById('modalNamaTes').textContent = laboratorium.nama_tes;
            document.getElementById('modalTanggalTes').textContent = laboratorium.tgl_tes;
        });
    });
</script>
@endsection