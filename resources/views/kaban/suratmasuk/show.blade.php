@extends('kaban.layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-file-alt text-info"></i> Detail Surat
    </h1>
    <a href="{{ route('kaban.suratmasuk') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 bg-gradient-info">
        <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-envelope"></i> Informasi Surat Masuk
        </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">Nomor Surat</th>
                        <td>: <strong>{{$disposisi->nomorsurat}}</strong></td>
                    </tr>
                    <tr>
                        <th>SKPD</th>
                        <td>: {{$disposisi->skpd}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Surat</th>
                        <td>: {{ \Carbon\Carbon::parse($disposisi->Tgl_Surat)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Diterima</th>
                        <td>: {{ \Carbon\Carbon::parse($disposisi->Tgl_Diterima)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <th>No Agenda</th>
                        <td>: {{$disposisi->No_Agenda}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th width="40%">Sifat</th>
                        <td>: 
                            @if($disposisi->Sifat == 'Sangat Segera')
                                <span class="badge badge-danger">{{$disposisi->Sifat}}</span>
                            @elseif($disposisi->Sifat == 'Segera')
                                <span class="badge badge-warning">{{$disposisi->Sifat}}</span>
                            @elseif($disposisi->Sifat == 'Rahasia')
                                <span class="badge badge-dark">{{$disposisi->Sifat}}</span>
                            @else
                                <span class="badge badge-secondary">{{$disposisi->Sifat}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Diteruskan Ke</th>
                        <td>: {{$disposisi->Diteruskan_Ke ?? '-'}}</td>
                    </tr>
                    <tr>
                        <th>Dokumen</th>
                        <td>: 
                            @if($disposisi->Dokumen)
                                <a href="{{ asset('uploads/disposisi/' . $disposisi->Dokumen) }}" 
                                   target="_blank" 
                                   class="btn btn-danger btn-sm">
                                    <i class="fas fa-file-pdf"></i> Lihat PDF
                                </a>
                            @else
                                <span class="text-muted">Tidak ada dokumen</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: 
                            @if($disposisi->status == 'selesai')
                                <span class="badge badge-success">Selesai</span>
                            @elseif($disposisi->status == 'diterima')
                                <span class="badge badge-info">Diterima</span>
                            @elseif($disposisi->status == 'terkirim')
                                <span class="badge badge-warning">Terkirim</span>
                            @else
                                <span class="badge badge-secondary">{{$disposisi->status}}</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        
        <hr>
        
        <div class="row">
            <div class="col-12">
                <h6 class="font-weight-bold text-primary">Perihal:</h6>
                <p class="text-justify">{{$disposisi->Perihal}}</p>
            </div>
        </div>
        
        <hr>
        
        <div class="row">
            <div class="col-md-6">
                <h6 class="font-weight-bold text-success">Dengan Hormat Harap:</h6>
                <p class="text-justify bg-light p-3 rounded">
                    {{$disposisi->dengan_hormat_harap ?? '-'}}
                </p>
            </div>
            <div class="col-md-6">
                <h6 class="font-weight-bold text-success">Catatan:</h6>
                <p class="text-justify bg-light p-3 rounded">
                    {{$disposisi->catatan ?? '-'}}
                </p>
            </div>
        </div>
        
        <!-- ✅ Tombol Edit Disposisi (jika status belum selesai) -->
        @if($disposisi->status != 'selesai')
        <hr>
        <div class="row">
            <div class="col-12 text-right">
                <a href="{{ route('kaban.suratmasuk.edit', urlencode($disposisi->nomorsurat)) }}" 
                   class="btn btn-primary">
                    <i class="fas fa-edit"></i> Beri Disposisi
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- ✅ Preview PDF di halaman (optional) -->
@if($disposisi->Dokumen)
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-gradient-danger">
        <h6 class="m-0 font-weight-bold text-white">
            <i class="fas fa-file-pdf"></i> Preview Dokumen
        </h6>
    </div>
    <div class="card-body">
        <div class="embed-responsive embed-responsive-16by9" style="height: 600px;">
            <iframe class="embed-responsive-item" 
                    src="{{ asset('uploads/disposisi/' . $disposisi->Dokumen) }}" 
                    type="application/pdf">
            </iframe>
        </div>
        <div class="text-center mt-3">
            <a href="{{ asset('uploads/disposisi/' . $disposisi->Dokumen) }}" 
               target="_blank" 
               class="btn btn-danger">
                <i class="fas fa-external-link-alt"></i> Buka di Tab Baru
            </a>
            <a href="{{ asset('uploads/disposisi/' . $disposisi->Dokumen) }}" 
               download 
               class="btn btn-success">
                <i class="fas fa-download"></i> Download PDF
            </a>
        </div>
    </div>
</div>
@endif

@endsection