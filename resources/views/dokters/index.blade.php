@extends('layouts.app')

@section('title', 'Data Dokter')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Dokter</h3>

    <a href="{{ route('dokters.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Dokter
    </a>
   
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($dokters->count() > 0)
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dokter</th>
                <th>Poliklinik</th>
                <th>SIP</th>
                <th>Tempat Lahir</th>
                <th>Nomor Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dokters as $index => $dokter)
            <tr>
                <td>{{ $index + $dokters->firstItem() }}</td>
                <td class="truncate">{{ $dokter->nm_dokter }}</td>
                <td class="truncate">{{ $dokter->poliklinik->nm_poli}}</td>
                <td class="truncate">{{ $dokter->SIP}}</td>
                <td class="truncate">{{ $dokter->tmpat_lhr}}</td>
                <td class="truncate">{{ $dokter->no_tlp}}</td>
                <td class="truncate">{{ $dokter->alamat}}</td>
                <td>
                    <button class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#detailModal" data-dokter="{{ json_encode($dokter) }}">
                        <i class="bi bi-eye"></i>
                    </button>
                    
                    <a href="{{ route('dokters.edit', $dokter->kd_dokter) }}" class="btn btn-warning btn-sm mb-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    
                    <form action="{{ route('dokters.destroy', $dokter->kd_dokter) }}" method="POST" class="d-inline">
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
<p class="text-center">Tidak ada data dokter.</p>
@endif

{{ $dokters->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Dokter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Dokter:</strong> <span id="modalNamaDokter"></span></p>
                <p><strong>Poliklinik:</strong> <span id="modalPoliklinik"></span></p>
                <p><strong>SIP:</strong> <span id="modalSIP"></span></p>
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
            const dokter = JSON.parse(button.getAttribute('data-dokter'));

            document.getElementById('modalNamaDokter').textContent = dokter.nm_dokter;
            document.getElementById('modalPoliklinik').textContent = dokter.poliklinik.nm_poli;
            document.getElementById('modalSIP').textContent = dokter.SIP;
        });
    });
</script>
@endsection