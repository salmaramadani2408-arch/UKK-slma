@extends('layouts/app')
@section('content')

@if(session('success'))
<p class="alert alert-success">{{session('success')}}</p>
@endif

<!-- Custom CSS for soft blue gradient header -->
<style>
.table thead th {
    background: linear-gradient(to right, #EFF6FF, #DBEAFE);
    color: #1D4ED8;
    font-weight: 600;
    border-color: #BFDBFE !important;
}
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Disposisi Surat Masuk</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Disposisi Surat Masuk</h6>
        </div>
        <div class="card-body">
            <a class="btn btn-primary mb-3" href="{{route('disposisi.create')}}">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            <th>Dokumen</th>
                            <th>Diteruskan Ke</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        @foreach($disposisi as $disposisi)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$disposisi->nomorsurat}}</td>
                            <td>{{$disposisi->skpd}}</td>
                            <td>{{$disposisi->Tgl_Surat}}</td>
                            <td>{{$disposisi->perihal}}</td>
                            <td>{{$disposisi->Tgl_Diterima}}</td>                                  
                            <td>{{$disposisi->No_Agenda}}</td>                                 
                            <td>{{$disposisi->Sifat}}</td>
                            <td>{{$disposisi->Dokumen}}</td>
                            <td>{{$disposisi->Diteruskan_Ke}}</td>
                            <td class="text-center">
                            <a href="{{ route('disposisi.edit', $disposisi->nomorsurat) }}"title="Edit"             class="text-warning mx-1">
                              <i class="fas fa-edit fa-sm"></i>
                            </a>

                           <form action="{{ route('disposisi.destroy', $disposisi->nomorsurat) }}"method="POST" 
                                style="display:inline;">
                            @csrf
                            @method('DELETE')
                         <button type="submit" 
                            class="btn btn-link p-0 m-0 text-danger"title="Hapus"onclick="return confirm('Yakin ingin menghapus data ini?')">
                              <i class="fas fa-trash fa-sm"></i>
                               </button>
                                   </form>
                              </td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection