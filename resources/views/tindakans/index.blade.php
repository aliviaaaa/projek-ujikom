@extends('layouts.app')

@section('title', 'Data Tindakan')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Tindakan</h3>
    @if(in_array(session('role'), ['admin', 'dokter', 'perawat']))
    <a href="{{ route('tindakans.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Tindakan
    </a>
    @endif
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($tindakans->count() > 0)
<div class="table-responsive">
    <table class="table table-hover table-bordered bg-white">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Tindakan</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tindakans as $index => $tindakan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="truncate">{{ $tindakan->nm_tindakan }}</td>
                <td class="truncate">{{ $tindakan->ket }}</td>
                <td>
                    <button class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#detailModal" data-tindakan="{{ json_encode($tindakan) }}">
                        <i class="bi bi-eye"></i>
                    </button>
                    <a href="{{ route('tindakans.edit', $tindakan->kd_tindakan) }}" class="btn btn-warning btn-sm mb-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('tindakans.destroy', $tindakan->kd_tindakan) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Yakin ingin menghapus?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<p class="text-center">Tidak ada data tindakan.</p>
@endif

{{ $tindakans->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Tindakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Tindakan:</strong> <span id="modalNamaTindakan"></span></p>
                <p><strong>Keterangan:</strong> <span id="modalDeskripsi"></span></p>
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
            const tindakan = JSON.parse(button.getAttribute('data-tindakan'));

            document.getElementById('modalNamaTindakan').textContent = tindakan.nm_tindakan;
            document.getElementById('modalDeskripsi').textContent = tindakan.deskripsi;
            document.getElementById('modalHarga').textContent = tindakan.harga;
        });
    });
</script>
@endsection