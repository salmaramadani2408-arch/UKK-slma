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
.badge-status-pending {
    background-color: #ffc107;
    color: #000;
}
.badge-status-dikaban {
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
            <span class="badge badge-status-pending mr-2">Pending</span>
            <span class="badge badge-status-dikaban mr-2">Di Kaban</span>
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
                        <td>{{$item->Tgl_Surat}}</td>
                        <td>{{$item->Perihal}}</td>
                        <td>{{$item->Tgl_Diterima}}</td>                                  
                        <td>{{$item->No_Agenda}}</td>                                 
                        <td>
                            @if($item->Sifat == 'Segera')
                                <span class="badge badge-danger">{{$item->Sifat}}</span>
                            @elseif($item->Sifat == 'Biasa')
                                <span class="badge badge-secondary">{{$item->Sifat}}</span>
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
                            @if($item->status == 'pending')
                                <span class="badge badge-status-pending">Pending</span>
                            @elseif($item->status == 'di_kaban')
                                <span class="badge badge-status-dikaban">Di Kaban</span>
                            @elseif($item->status == 'selesai')
                                <span class="badge badge-status-selesai">Selesai</span>
                            @else
                                <span class="badge badge-secondary">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('kaban.suratmasuk.show', $item->nomorsurat) }}" 
                               title="Detail & Disposisi" 
                               class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                            @if($item->status != 'selesai')
                                <a href="{{ route('kaban.suratmasuk.edit', $item->nomorsurat) }}" 
                                   title="Edit Disposisi" 
                                   class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
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