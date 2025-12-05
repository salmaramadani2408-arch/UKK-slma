@extends('layouts.app')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-edit text-warning"></i> Edit Surat Disposisi
    </h1>
    <a href="{{ route('admin.disposisi.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<form action="{{ route('admin.disposisi.update', urlencode($disposisi->nomorsurat)) }}" 
      method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-warning">
                <i class="fas fa-edit"></i> Form Edit Disposisi
            </h6>
        </div>

        <div class="card-body">
            <div class="alert alert-warning mb-4">
                <i class="fas fa-exclamation-triangle"></i> 
                <strong>Perhatian:</strong> Pastikan data yang Anda edit sudah benar!
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Nomor Surat <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nomor_surat') is-invalid @enderror" 
                               name="nomor_surat" 
                               value="{{ old('nomor_surat', $disposisi->nomorsurat) }}" 
                               required>
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">
                            SKPD <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('skpd') is-invalid @enderror" 
                               name="skpd" 
                               value="{{ old('skpd', $disposisi->skpd) }}" 
                               required>
                        @error('skpd')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">
                            Tanggal Surat <span class="text-danger">*</span>
                        </label>
                        <input type="date" 
                               class="form-control @error('tgl_surat') is-invalid @enderror" 
                               name="tgl_surat" 
                               value="{{ old('tgl_surat', $disposisi->Tgl_Surat ? \Carbon\Carbon::parse($disposisi->Tgl_Surat)->format('Y-m-d') : '') }}" 
                               required>
                        @error('tgl_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">
                            Tanggal Diterima <span class="text-danger">*</span>
                        </label>
                        <input type="date" 
                               class="form-control @error('tgl_diterima') is-invalid @enderror" 
                               name="tgl_diterima" 
                               value="{{ old('tgl_diterima', $disposisi->Tgl_Diterima ? \Carbon\Carbon::parse($disposisi->Tgl_Diterima)->format('Y-m-d') : '') }}" 
                               required>
                        @error('tgl_diterima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">
                            Nomor Agenda <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('no_agenda') is-invalid @enderror" 
                               name="no_agenda" 
                               value="{{ old('no_agenda', $disposisi->No_Agenda) }}" 
                               required>
                        @error('no_agenda')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Perihal <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('perihal') is-invalid @enderror" 
                                  name="perihal" 
                                  rows="4" 
                                  required>{{ old('perihal', $disposisi->Perihal ?? $disposisi->perihal) }}</textarea>
                        @error('perihal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">
                            Sifat Surat <span class="text-danger">*</span>
                        </label>
                        <select class="form-control @error('sifat') is-invalid @enderror" 
                                name="sifat" 
                                required>
                            <option value="">-- Pilih Sifat Surat --</option>
                            <option value="Biasa" {{ old('sifat', $disposisi->Sifat) == 'Biasa' ? 'selected' : '' }}>Biasa</option>
                            <option value="Segera" {{ old('sifat', $disposisi->Sifat) == 'Segera' ? 'selected' : '' }}>Segera</option>
                            <option value="Sangat Segera" {{ old('sifat', $disposisi->Sifat) == 'Sangat Segera' ? 'selected' : '' }}>Sangat Segera</option>
                            <option value="Rahasia" {{ old('sifat', $disposisi->Sifat) == 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                        </select>
                        @error('sifat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($disposisi->Dokumen)
                    <div class="form-group">
                        <label class="font-weight-bold">Dokumen Saat Ini</label>
                        <div class="alert alert-info py-2">
                            <i class="fas fa-file-pdf text-danger"></i> 
                            <a href="{{ asset('uploads/disposisi/' . $disposisi->Dokumen) }}" target="_blank" class="font-weight-bold">
                                {{ $disposisi->Dokumen }}
                            </a>
                        </div>
                    </div>
                    @endif

                    <div class="form-group">
                        <label class="font-weight-bold">
                            Upload Dokumen Baru (PDF) <span class="text-muted">(Opsional)</span>
                        </label>
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('dokumen') is-invalid @enderror" 
                                   id="dokumen"
                                   name="dokumen" 
                                   accept=".pdf">
                            <label class="custom-file-label" for="dokumen">Pilih file PDF baru...</label>
                        </div>
                        @error('dokumen')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Kosongkan jika tidak ingin mengubah dokumen. Format: PDF, Max: 2MB
                        </small>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="form-group mb-0">
                <button type="submit" class="btn btn-warning btn-lg px-5">
                    <i class="fas fa-save"></i> Update Data
                </button>
                <a href="{{ route('admin.disposisi.index') }}" class="btn btn-secondary btn-lg px-5">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>

        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var fileInput = document.querySelector('.custom-file-input');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            var fileName = e.target.files[0] ? e.target.files[0].name : 'Pilih file PDF baru...';
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    }
});
</script>

@endsection