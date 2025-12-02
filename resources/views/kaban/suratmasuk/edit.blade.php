@extends('kaban.layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-edit text-warning"></i> Isi Disposisi Surat
    </h1>
    <a href="{{ route('kaban.suratmasuk') }}" class="btn btn-secondary btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <!-- Detail Surat (Readonly) -->
    <div class="col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-gradient-info">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-envelope"></i> Detail Surat Masuk
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">Nomor Surat</label>
                            <input type="text" class="form-control" value="{{$disposisi->nomorsurat}}" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">SKPD</label>
                            <input type="text" class="form-control" value="{{$disposisi->skpd}}" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">Tanggal Surat</label>
                            <input type="text" class="form-control" value="{{$disposisi->Tgl_Surat}}" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">Tanggal Diterima</label>
                            <input type="text" class="form-control" value="{{$disposisi->Tgl_Diterima}}" readonly>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold">No Agenda</label>
                            <input type="text" class="form-control" value="{{$disposisi->No_Agenda}}" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">Sifat</label>
                            <input type="text" class="form-control" value="{{$disposisi->Sifat}}" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">Dokumen</label>
                            <input type="text" class="form-control" value="{{$disposisi->Dokumen}}" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="font-weight-bold">Perihal</label>
                    <textarea class="form-control" rows="3" readonly>{{$disposisi->Perihal}}</textarea>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Form Input Disposisi Kaban -->
    <div class="col-lg-5">
        <div class="card shadow mb-4 border-left-success">
            <div class="card-header py-3 bg-gradient-success">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-pen"></i> Form Disposisi Kaban
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('kaban.suratmasuk.update', $disposisi->nomorsurat) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="alert alert-info alert-sm">
                        <i class="fas fa-info-circle"></i> Lengkapi form disposisi di bawah ini
                    </div>
                    
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Diteruskan Ke <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               name="Diteruskan_Ke" 
                               class="form-control @error('Diteruskan_Ke') is-invalid @enderror" 
                               value="{{old('Diteruskan_Ke', $disposisi->Diteruskan_Ke)}}"
                               placeholder="Contoh: Kabag Keuangan, Kabag Umum"
                               required>
                        @error('Diteruskan_Ke')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            <i class="fas fa-user"></i> Ke bagian/unit mana surat ini diteruskan
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Status <span class="text-danger">*</span>
                        </label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="pending" {{ old('status', $disposisi->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="di_kaban" {{ old('status', $disposisi->status) == 'di_kaban' ? 'selected' : '' }}>Di Kaban</option>
                            <option value="selesai" {{ old('status', $disposisi->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            <i class="fas fa-flag"></i> Status proses disposisi
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Dengan Hormat Harap
                        </label>
                        <textarea name="dengan_hormat_harap" 
                                  class="form-control @error('dengan_hormat_harap') is-invalid @enderror" 
                                  rows="4" 
                                  placeholder="Instruksi disposisi (opsional)">{{old('dengan_hormat_harap', $disposisi->dengan_hormat_harap)}}</textarea>
                        @error('dengan_hormat_harap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Instruksi tindak lanjut
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <label class="font-weight-bold">Catatan</label>
                        <textarea name="catatan" 
                                  class="form-control" 
                                  rows="3" 
                                  placeholder="Catatan tambahan (opsional)">{{old('catatan', $disposisi->catatan)}}</textarea>
                        <small class="form-text text-muted">
                            <i class="fas fa-sticky-note"></i> Catatan tambahan jika diperlukan
                        </small>
                    </div>
                    
                    <hr>
                    
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-save"></i> Simpan Disposisi
                    </button>
                    
                    <a href="{{ route('kaban.suratmasuk') }}" class="btn btn-secondary btn-block">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection