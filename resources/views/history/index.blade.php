@extends('layouts/app')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">History</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data History Surat Disposisi</h6>
        </div>
        <div class="card-body">

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
                            <th>Dikirim Oleh</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($history as $index => $row)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $row->nomorsurat }}</td>
                            <td>{{ $row->skpd }}</td>
                            <td>{{ $row->Perihal }}</td>
                            <td>{{ $row->Tgl_Surat ? $row->Tgl_Surat->format('d/m/Y') : '-' }}</td>
                            <td>{{ $row->Diteruskan_Ke }}</td>
                            <td>{{ $row->dikirim_oleh ?? 'Admin' }}</td>
                            <td>
                                @if($row->status == 'selesai')
                                    <span class="badge badge-success">Selesai</span>
                                @elseif($row->status == 'diterima')
                                    <span class="badge badge-info">Diterima</span>
                                @elseif($row->status == 'terkirim')
                                    <span class="badge badge-warning">Terkirim</span>
                                @else
                                    <span class="badge badge-secondary">{{ $row->status }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                <i class="fas fa-inbox"></i> Belum ada history surat
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