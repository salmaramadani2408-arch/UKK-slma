@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle"></i> {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- Custom CSS -->
<style>
.table thead th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-weight: 600;
    border: none !important;
    vertical-align: middle;
    text-align: center;
}

.table tbody td {
    vertical-align: middle;
}

.table tbody tr {
    cursor: pointer;
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background-color: #f8f9fc;
    transform: scale(1.01);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.badge-sifat {
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
}

/* Modal Custom Styling */
.modal-content {
    border-radius: 15px;
    border: none;
    box-shadow: 0 5px 30px rgba(0,0,0,0.3);
}

.modal-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px 15px 0 0;
    border: none;
}

.modal-header .close {
    color: white;
    opacity: 0.8;
}

.modal-header .close:hover {
    opacity: 1;
}

.action-btn {
    padding: 12px 30px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    border: none;
    min-width: 120px;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.btn-edit-action {
    background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
    color: white;
}

.btn-delete-action {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.detail-info {
    background: #f8f9fc;
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.detail-info p {
    margin-bottom: 8px;
    color: #5a5c69;
}

.detail-info strong {
    color: #2e59d9;
}
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-inbox text-primary"></i> Disposisi Surat Masuk
        </h1>
    </div>

    <!-- DataTable Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-table"></i> Data Disposisi Surat Masuk
                <small class="float-right" style="font-size: 12px; opacity: 0.9;">
                    <i class="fas fa-info-circle"></i> Klik baris untuk opsi Edit/Hapus
                </small>
            </h6>
        </div>
        <div class="card-body">
            <a class="btn btn-primary mb-3 shadow-sm" href="{{ route('admin.disposisi.create') }}" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
            
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nomor Surat</th>
                            <th>SKPD</th>
                            <th>Tgl Surat</th>
                            <th>Perihal</th>
                            <th>Tgl Diterima</th>
                            <th>No Agenda</th>
                            <th>Sifat</th>
                            <th>Dokumen</th>
                            <th>Diteruskan Ke</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($disposisi as $index => $item)
                        <tr class="row-clickable" 
                            data-nomor="{{ $item->nomorsurat }}"
                            data-skpd="{{ $item->skpd }}"
                            data-perihal="{{ $item->Perihal ?? $item->perihal }}"
                            data-tgl-surat="{{ $item->Tgl_Surat ? \Carbon\Carbon::parse($item->Tgl_Surat)->format('d/m/Y') : '-' }}"
                            data-edit-url="{{ route('admin.disposisi.edit', urlencode($item->nomorsurat)) }}"
                            data-delete-url="{{ route('admin.disposisi.destroy', urlencode($item->nomorsurat)) }}">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td><strong>{{ $item->nomorsurat }}</strong></td>
                            <td>{{ $item->skpd }}</td>
                            <td>{{ $item->Tgl_Surat ? \Carbon\Carbon::parse($item->Tgl_Surat)->format('d/m/Y') : '-' }}</td>
                            <td>{{ $item->Perihal ?? $item->perihal }}</td>
                            <td>{{ $item->Tgl_Diterima ? \Carbon\Carbon::parse($item->Tgl_Diterima)->format('d/m/Y') : '-' }}</td>
                            <td class="text-center">{{ $item->No_Agenda ?? '-' }}</td>
                            <td class="text-center">
                                @if($item->Sifat)
                                    @if($item->Sifat == 'Sangat Segera')
                                        <span class="badge badge-danger badge-sifat">{{ $item->Sifat }}</span>
                                    @elseif($item->Sifat == 'Segera')
                                        <span class="badge badge-warning badge-sifat">{{ $item->Sifat }}</span>
                                    @elseif($item->Sifat == 'Rahasia')
                                        <span class="badge badge-dark badge-sifat">{{ $item->Sifat }}</span>
                                    @else
                                        <span class="badge badge-info badge-sifat">{{ $item->Sifat }}</span>
                                    @endif
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td onclick="event.stopPropagation();">
                                @if($item->Dokumen)
                                    <a href="{{ asset('uploads/disposisi/' . $item->Dokumen) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-file-pdf"></i> Lihat
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-success">{{ $item->Diteruskan_Ke ?? '-' }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-gray-300 mb-3 d-block"></i>
                                <p class="text-muted mb-0">Belum ada data disposisi</p>
                                <a href="{{ route('admin.disposisi.create') }}" class="btn btn-sm btn-primary mt-3">
                                    <i class="fas fa-plus"></i> Tambah Data Pertama
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal untuk Aksi -->
<div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="actionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionModalLabel">
                    <i class="fas fa-cog"></i> Aksi Disposisi
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="detail-info">
                    <p><strong>Nomor Surat:</strong> <span id="modal-nomor"></span></p>
                    <p><strong>SKPD:</strong> <span id="modal-skpd"></span></p>
                    <p><strong>Perihal:</strong> <span id="modal-perihal"></span></p>
                    <p class="mb-0"><strong>Tanggal Surat:</strong> <span id="modal-tgl"></span></p>
                </div>
                
                <div class="text-center">
                    <p class="text-muted mb-3">Pilih aksi yang ingin dilakukan:</p>
                    
                    <a href="#" id="btn-edit-modal" class="btn action-btn btn-edit-action mr-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    
                    <button type="button" id="btn-delete-modal" class="btn action-btn btn-delete-action">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Delete Hidden -->
<form id="delete-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

<script>
// Tunggu sampai semua script selesai load
jQuery(document).ready(function($) {
    console.log('Script loaded'); // Debug
    
    // Tunggu DataTable selesai render
    setTimeout(function() {
        console.log('Rows found:', $('.row-clickable').length); // Debug
        
        // Handle row click dengan event delegation
        $('#dataTable tbody').on('click', 'tr.row-clickable', function() {
            var nomor = $(this).data('nomor');
            var skpd = $(this).data('skpd');
            var perihal = $(this).data('perihal');
            var tglSurat = $(this).data('tgl-surat');
            var editUrl = $(this).data('edit-url');
            var deleteUrl = $(this).data('delete-url');
            
            console.log('Row clicked:', nomor); // Debug
            
            // Set data ke modal
            $('#modal-nomor').text(nomor);
            $('#modal-skpd').text(skpd);
            $('#modal-perihal').text(perihal);
            $('#modal-tgl').text(tglSurat);
            
            // Set URL untuk tombol
            $('#btn-edit-modal').attr('href', editUrl);
            $('#delete-form').attr('action', deleteUrl);
            
            // Simpan nomor surat untuk konfirmasi hapus
            $('#btn-delete-modal').data('nomor', nomor);
            
            // Tampilkan modal
            $('#actionModal').modal('show');
        });
        
        // Handle delete button
        $('#btn-delete-modal').on('click', function() {
            var nomor = $(this).data('nomor');
            
            if(confirm('Yakin ingin menghapus surat ' + nomor + '?')) {
                $('#delete-form').submit();
            }
        });
        
        // Prevent event bubbling untuk link dokumen
        $('#dataTable tbody').on('click', 'a.btn-info', function(e) {
            e.stopPropagation();
        });
    }, 500); // Tunggu 500ms untuk DataTable selesai render
});
</script>