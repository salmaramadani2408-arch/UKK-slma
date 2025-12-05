@extends('layouts/app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">History Disposisi</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data History Surat</h6>
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nomor Surat</th>
                            <th>SKPD</th>
                            <th>Perihal</th>
                            <th>Tgl Surat</th>
                            <th>Diteruskan Ke</th>
                            <th>Status</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                      @forelse($disposisi as $index => $row)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $row->nomorsurat }}</td>
        <td>{{ $row->skpd }}</td>
        <td>{{ $row->Perihal }}</td>
        <td>{{ $row->Tgl_Surat ? $row->Tgl_Surat->format('d/m/Y') : '-' }}</td>
        <td>{{ $row->Diteruskan_Ke }}</td>
        <td>
            @if($row->status == 'selesai')
                <span class="badge badge-success">Selesai</span>
            @elseif($row->status == 'pending')
                <span class="badge badge-warning">Pending</span>
            @else
                <span class="badge badge-info">{{ $row->status }}</span>
            @endif
        </td>
        <td>
            <a href="{{ route('admin.disposisi.edit', $row->nomorsurat) }}" class="btn btn-sm btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form action="{{ route('admin.disposisi.destroy', $row->nomorsurat) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="8" class="text-center text-muted">
            <i class="fas fa-inbox"></i> Belum ada data surat masuk
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