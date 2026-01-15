@extends('kaban.layouts.app')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('success')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Custom CSS for soft blue gradient header -->
<style>
.table thead th {
    background: linear-gradient(to right, #EFF6FF, #DBEAFE);
    color: #1D4ED8;
    font-weight: 600;
    border-color: #BFDBFE !important;
}
.badge-status-terkirim {
    background-color: #ffc107;
    color: #000;
}
.badge-status-diterima {
    background-color: #17a2b8;
    color: #fff;
}
.badge-status-selesai {
    background-color: #28a745;
    color: #fff;
}
</style>

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Surat Masuk Kaban</h1>
<p class="mb-4">Daftar surat masuk yang perlu ditindaklanjuti oleh Kepala Badan.</p>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-success">Data Surat Masuk</h6>
        <div>
            <span class="badge badge-status-terkirim mr-2">Terkirim</span>
            <span class="badge badge-status-diterima mr-2">Diterima</span>
            <span class="badge badge-status-selesai">Selesai</span>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Surat</th>
                        <th>SKPD</th>
                        <th>Tgl Surat</th>
                        <th>Perihal</th>
                        <th>Tgl Diterima</th>
                        <th>No Agenda</th>
                        <th>Sifat</th>
                        <th>Diteruskan Ke</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1 @endphp
                    @forelse($disposisi as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td><strong>{{$item->nomorsurat}}</strong></td>
                        <td>{{$item->skpd}}</td>
                        <td>{{ \Carbon\Carbon::parse($item->Tgl_Surat)->format('d/m/Y') }}</td>
                        <td>{{$item->Perihal}}</td>
                        <td>{{ \Carbon\Carbon::parse($item->Tgl_Diterima)->format('d/m/Y') }}</td>                                  
                        <td>{{$item->No_Agenda}}</td>                                 
                        <td>
                            @if($item->Sifat == 'Sangat Segera')
                                <span class="badge badge-danger">{{$item->Sifat}}</span>
                            @elseif($item->Sifat == 'Segera')
                                <span class="badge badge-warning">{{$item->Sifat}}</span>
                            @elseif($item->Sifat == 'Biasa')
                                <span class="badge badge-secondary">{{$item->Sifat}}</span>
                            @elseif($item->Sifat == 'Rahasia')
                                <span class="badge badge-dark">{{$item->Sifat}}</span>
                            @else
                                <span class="badge badge-info">{{$item->Sifat}}</span>
                            @endif
                        </td>
                        <td>
                            @if($item->Diteruskan_Ke)
                                <small class="text-muted">{{$item->Diteruskan_Ke}}</small>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($item->status == 'terkirim')
                                <span class="badge badge-status-terkirim">Terkirim</span>
                            @elseif($item->status == 'diterima')
                                <span class="badge badge-status-diterima">Diterima</span>
                            @elseif($item->status == 'selesai')
                                <span class="badge badge-status-selesai">Selesai</span>
                            @else
                                <span class="badge badge-secondary">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <!-- ✅ Tombol Detail dengan encode -->
                            <a href="{{ route('kaban.suratmasuk.show', urlencode($item->nomorsurat)) }}" 
                               title="Detail & Disposisi" 
                               class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            
                            <!-- ✅ Tombol Lihat PDF langsung -->
                            @if($item->Dokumen)
                                <a href="{{ asset('uploads/disposisi/' . $item->Dokumen) }}" 
                                   target="_blank"
                                   title="Lihat PDF" 
                                   class="btn btn-danger btn-sm">
                                    <i class="fas fa-file-pdf"></i> PDF
                                </a>
                            @endif
                            
                            <!-- ✅ TOMBOL EDIT DIHAPUS -->
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Tidak ada data surat masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection