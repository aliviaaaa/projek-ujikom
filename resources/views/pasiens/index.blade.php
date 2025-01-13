@extends('layouts.app')

@section('title', 'Data Pasien')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Data Pasien</h3>
    @if(in_array(session('role'), ['admin', 'perawat']))
    <a href="{{ route('pasiens.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Pasien
    </a>
    @endif
</div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($pasiens->count() > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Nomor Pasien</th>
                    <th>Jenis Kelamin</th>
                    <th>Agama</th>
                    <th>Alamat</th>
                    <th>Tanggal Lahir</th>
                    <th>Usia</th>
                    <th>Nomor Telepon</th>
                    <th>Nomor KK</th>
                    <th>Hubungan Keluarga</th>
                    @if(session('role') == 'admin' || session('role') == 'perawat')
                    <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($pasiens as $index => $pasien)
                <tr>
                    <td>{{ $index + $pasiens->firstItem() }}</td>
                    <td class="truncate">{{ $pasien->nm_pasien }}</td>
                    <td class="truncate">{{ $pasien->no_pasien }}</td>
                    <td class="truncate">{{ $pasien->j_kel }}</td>
                    <td class="truncate">{{ $pasien->agama }}</td>
                    <td class="truncate">{{ $pasien->alamat }}</td>
                    <td class="truncate">{{ $pasien->tgl_lhr }}</td>
                    <td class="truncate">{{ $pasien->usia }}</td>
                    <td class="truncate">{{ $pasien->no_tlp }}</td>
                    <td class="truncate">{{ $pasien->nm_kk }}</td>
                    <td class="truncate">{{ $pasien->hub_kel }}</td>
                    <td>
                        @if(in_array(session('role'), ['admin', 'dokter', 'perawat', 'pasien']))
                        <button class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#detailModal" data-pasien="{{ json_encode($pasien) }}">
                            <i class="bi bi-eye"></i>
                        </button>
                        @endif
                        @if(in_array(session('role'), ['admin', 'dokter']))
                        <a href="{{ route('pasiens.edit', $pasien->no_pasien) }}" class="btn btn-warning btn-sm mb-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @endif
                        @if(in_array(session('role'), ['admin']))
                        <form action="{{ route('pasiens.destroy', $pasien->no_pasien) }}" method="POST" class="d-inline">
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
    <p class="text-center">Tidak ada data pasien.</p>
    @endif

    {{ $pasiens->links('pagination::bootstrap-4', ['class' => 'pagination-sm']) }}

    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pasien</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Pasien:</strong> <span id="modalNamaPasien"></span></p>
                    <p><strong>Nomor Pasien:</strong> <span id="modalNomorPasien"></span></p>
                    <p><strong>Jenis Kelamin:</strong> <span id="modalJenisKelamin"></span></p>
                    <p><strong>Agama:</strong> <span id="modalAgama"></span></p>
                    <p><strong>Alamat:</strong> <span id="modalAlamat"></span></p>
                    <p><strong>Tanggal Lahir:</strong> <span id="modalTanggalLahir"></span></p>
                    <p><strong>Usia:</strong> <span id="modalUsia"></span></p>
                    <p><strong>Nomor Telepon:</strong> <span id="modalNomorTelepon"></span></p>
                    <p><strong>Nomor KK:</strong> <span id="modalNomorKK"></span></p>
                    <p><strong>Hubungan Keluarga:</strong> <span id="modalHubunganKeluarga"></span></p>
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
            const pasien = JSON.parse(button.getAttribute('data-pasien'));

            document.getElementById('modalNamaPasien').textContent = pasien.nm_pasien;
            document.getElementById('modalNomorPasien').textContent = pasien.no_pasien;
            document.getElementById('modalJenisKelamin').textContent = pasien.j_kel;
            document.getElementById('modalAgama').textContent = pasien.agama;
            document.getElementById('modalAlamat').textContent = pasien.alamat;
            document.getElementById('modalTanggalLahir').textContent = pasien.tgl_lhr;
            document.getElementById('modalUsia').textContent = pasien.usia;
            document.getElementById('modalNomorTelepon').textContent = pasien.no_tlp;
            document.getElementById('modalNomorKK').textContent = pasien.nm_kk;
            document.getElementById('modalHubunganKeluarga').textContent = pasien.hub_kel;
        });
    });
</script>
@endsection