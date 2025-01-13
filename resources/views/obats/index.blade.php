@extends('layouts.app')

@section('title', 'Data Obat')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Obat</h3>
    @if(in_array(session('role'), ['admin', 'farmasi']))
    <a href="{{ route('obats.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Obat
    </a>
    @endif
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($obats->count() > 0)
<div class="table-responsive">
    <table class="table table-hover table-bordered bg-white">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Jumlah</th>
                <th>Ukuran</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($obats as $index => $obat)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="truncate">{{ $obat->nm_obat }}</td>
                <td class="truncate">{{ $obat->jml_obat }}</td>
                <td class="truncate">{{ $obat->ukuran }}</td>
                <td class="truncate">{{ number_format($obat->harga, 2) }}</td>
                <td>
                    @if(in_array(session('role'), ['admin', 'farmasi']))
                    <button class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#detailModal" data-obat="{{ json_encode($obat) }}">
                        <i class="bi bi-eye"></i>
                    </button>
                    @endif
                    @if(in_array(session('role'), ['admin', 'farmasi']))
                    <a href="{{ route('obats.edit', $obat->kd_obat) }}" class="btn btn-warning btn-sm mb-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    @endif
                    @if(in_array(session('role'), ['admin', 'farmasi']))
                    <form action="{{ route('obats.destroy', $obat->kd_obat) }}" method="POST" class="d-inline">
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
<p class="text-center">Tidak ada data obat.</p>
@endif

{{ $obats->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}

<!-- Detail Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Obat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Nama Obat:</strong> <span id="modalNamaObat"></span></p>
                <p><strong>Jumlah:</strong> <span id="modalJumlah"></span></p>
                <p><strong>Ukuran:</strong> <span id="modalUkuran"></span></p>
                <p><strong>Harga:</strong> <span id="modalHarga"></span></p>
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
            const obat = JSON.parse(button.getAttribute('data-obat'));

            document.getElementById('modalNamaObat').textContent = obat.nm_obat;
            document.getElementById('modalJumlah').textContent = obat.jml_obat;
            document.getElementById('modalUkuran').textContent = obat.ukuran;
            document.getElementById('modalHarga').textContent = obat.harga;
        });
    });
</script>
@endsection