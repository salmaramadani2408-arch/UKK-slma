@extends('layouts.app')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fas fa-plus-circle text-primary"></i> Formulir Tambah Surat Disposisi
    </h1>
    <a href="{{ route('admin.disposisi.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<form action="{{ route('admin.disposisi.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-edit"></i> Form Input Disposisi
            </h6>
        </div>

        <div class="card-body">
            <!-- Alert Info -->
            <div class="alert alert-info mb-4">
                <i class="fas fa-info-circle"></i> 
                <strong>Informasi:</strong> Surat ini akan otomatis diteruskan ke <strong>Kepala Badan (Kaban)</strong>
            </div>

            <!-- Hidden Input -->
            <input type="hidden" name="diteruskan_ke" value="Kepala Badan">

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <!-- Nomor Surat -->
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Nomor Surat <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('nomor_surat') is-invalid @enderror" 
                               name="nomor_surat" 
                               value="{{ old('nomor_surat') }}" 
                               required>
                        @error('nomor_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- SKPD -->
                    <div class="form-group">
                        <label class="font-weight-bold">
                            SKPD <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('skpd') is-invalid @enderror" 
                               name="skpd" 
                               value="{{ old('skpd') }}" 
                               required>
                        @error('skpd')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Surat -->
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Tanggal Surat <span class="text-danger">*</span>
                        </label>
                        <input type="date" 
                               class="form-control @error('tgl_surat') is-invalid @enderror" 
                               name="tgl_surat" 
                               value="{{ old('tgl_surat') }}" 
                               required>
                        @error('tgl_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Diterima -->
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Tanggal Diterima <span class="text-danger">*</span>
                        </label>
                        <input type="date" 
                               class="form-control @error('tgl_diterima') is-invalid @enderror" 
                               name="tgl_diterima" 
                               value="{{ old('tgl_diterima') }}" 
                               required>
                        @error('tgl_diterima')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Nomor Agenda -->
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Nomor Agenda <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('no_agenda') is-invalid @enderror" 
                               name="no_agenda" 
                               value="{{ old('no_agenda') }}" 
                               required>
                        @error('no_agenda')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <!-- Perihal -->
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Perihal <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('perihal') is-invalid @enderror" 
                                  name="perihal" 
                                  rows="4" 
                                  required>{{ old('perihal') }}</textarea>
                        @error('perihal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Jelaskan secara detail perihal surat
                        </small>
                    </div>

                    <!-- Sifat Surat -->
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Sifat Surat <span class="text-danger">*</span>
                        </label>
                        <select class="form-control @error('sifat') is-invalid @enderror" 
                                name="sifat" 
                                required>
                            <option value="">-- Pilih Sifat Surat --</option>
                            <option value="Biasa" {{ old('sifat') == 'Biasa' ? 'selected' : '' }}>Biasa</option>
                            <option value="Segera" {{ old('sifat') == 'Segera' ? 'selected' : '' }}>Segera</option>
                            <option value="Sangat Segera" {{ old('sifat') == 'Sangat Segera' ? 'selected' : '' }}>Sangat Segera</option>
                            <option value="Rahasia" {{ old('sifat') == 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                        </select>
                        @error('sifat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload Dokumen -->
                    <div class="form-group">
                        <label class="font-weight-bold">
                            Upload Dokumen (PDF) <span class="text-danger">*</span>
                        </label>
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('dokumen') is-invalid @enderror" 
                                   id="dokumen"
                                   name="dokumen" 
                                   accept=".pdf"
                                   required>
                            <label class="custom-file-label" for="dokumen">Pilih file PDF...</label>
                        </div>
                        @error('dokumen')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            <i class="fas fa-info-circle"></i> Format: PDF, Maksimal: 2MB
                        </small>
                    </div>
                </div>
            </div>

            <hr class="my-4">

          <!-- Buttons -->
<div class="form-group mb-0">
    <button type="submit" name="action" value="save" class="btn btn-primary btn-lg px-5">
        <i class="fas fa-save"></i> Simpan
    </button>
    <button type="submit" name="action" value="send" class="btn btn-success btn-lg px-5">
        <i class="fas fa-paper-plane"></i> Kirim
    </button>
</div>

        </div>
    </div>
</form>

<!-- Script untuk menampilkan nama file yang dipilih -->
<script>
document.querySelector('.custom-file-input').addEventListener('change', function(e) {
    var fileName = e.target.files[0] ? e.target.files[0].name : 'Pilih file PDF...';
    var nextSibling = e.target.nextElementSibling;
    nextSibling.innerText = fileName;
});
</script>

@endsection