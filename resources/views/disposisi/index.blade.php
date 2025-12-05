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

.badge-sifat {
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 11px;
    font-weight: 600;
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
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($disposisi as $index => $item)
                        <tr>
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
                            <td>
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
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.disposisi.edit', $item->nomorsurat) }}" 
                                       class="btn btn-sm btn-warning" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.disposisi.destroy', $item->nomorsurat) }}" 
                                          method="POST" 
                                          style="display:inline;"
                                          onsubmit="return confirm('Yakin ingin menghapus surat {{ $item->nomorsurat }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger" 
                                                title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center py-5">
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

@endsection