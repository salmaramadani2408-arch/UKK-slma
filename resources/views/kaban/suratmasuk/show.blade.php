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
                        <td>: {{$disposisi->Tgl_Surat}}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Diterima</th>
                        <td>: {{$disposisi->Tgl_Diterima}}</td>
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
                            @if($disposisi->Sifat == 'Segera')
                                <span class="badge badge-danger">{{$disposisi->Sifat}}</span>
                            @else
                                <span class="badge badge-secondary">{{$disposisi->Sifat}}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Diteruskan Ke</th>
                        <td>: {{$disposisi->Diteruskan_Ke}}</td>
                    </tr>
                    <tr>
                        <th>Dokumen</th>
                        <td>: {{$disposisi->Dokumen}}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: 
                            @if($disposisi->status == 'selesai')
                                <span class="badge badge-success">Selesai</span>
                            @else
                                <span class="badge badge-warning">{{$disposisi->status}}</span>
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
                    {{$disposisi->Dengan_Hormat_Harap ?? '-'}}
                </p>
            </div>
            <div class="col-md-6">
                <h6 class="font-weight-bold text-success">Catatan:</h6>
                <p class="text-justify bg-light p-3 rounded">
                    {{$disposisi->Catatan ?? '-'}}
                </p>
            </div>
        </div>
    </div>
</div>

@endsection