@extends('layouts.app')

@section('title', 'Data Poliklinik')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Poliklinik</h3>
    
    <a href="{{ route('polikliniks.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Poliklinik
    </a>
    
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($polikliniks->count() > 0)
<div class="table-responsive">
    <table class="table table-hover table-bordered bg-white">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Poliklinik</th>
                <th>Lantai</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($polikliniks as $index => $poliklinik)
            <tr>
                <td>{{ $index + $polikliniks->firstItem() }}</td>
                <td class="truncate">{{ $poliklinik->nm_poli }}</td>
                <td class="truncate">{{ $poliklinik->lantai }}</td>
                <td>
                    <button class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#detailModal" data-poliklinik="{{ json_encode($poliklinik) }}">
                        <i class="bi bi-eye"></i>
                    </button>
                    
                    <a href="{{ route('polikliniks.edit', $poliklinik->kd_poli) }}" class="btn btn-warning btn-sm mb-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    
                    <form action="{{ route('polikliniks.destroy', $poliklinik->kd_poli) }}" method="POST" class="d-inline">
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
<p class="text-center">Tidak ada data poliklinik.</p>
@endif

{{ $polikliniks->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Poliklinik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Poliklinik:</strong> <span id="modalNamaPoliklinik"></span></p>
                <p><strong>Lantai:</strong> <span id="modalLantai"></span></p>
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
            const poliklinik = JSON.parse(button.getAttribute('data-poliklinik'));

            document.getElementById('modalNamaPoliklinik').textContent = poliklinik.nm_poli;
            document.getElementById('modalLantai').textContent = poliklinik.lantai;
        });
    });
</script>
@endsection