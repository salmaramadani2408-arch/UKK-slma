@extends('layouts/app')

@section('content')
<form action="{{ route('disposisi.update', $disposisi->nomorsurat) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Surat Disposisi</h6>
                </div>

                <div class="card-body">
                    <!-- Alert Info Diteruskan -->
                    <div class="alert alert-info mb-3">
                        <i class="fas fa-info-circle"></i> Surat ini akan otomatis diteruskan ke <strong>Kepala Badan (Kaban)</strong>
                    </div>
                    <input type="hidden" name="diteruskan_ke" value="Kepala Badan">

                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <!-- Nomor Surat -->
                            <div class="form-group">
                                <label>Nomor Surat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm @error('nomor_surat') is-invalid @enderror" 
                                       name="nomor_surat" value="{{ old('nomor_surat', $disposisi->nomorsurat) }}" required>
                                @error('nomor_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- SKPD -->
                            <div class="form-group">
                                <label>SKPD <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm @error('skpd') is-invalid @enderror" 
                                       name="skpd" value="{{ old('skpd', $disposisi->skpd) }}" required>
                                @error('skpd')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Row untuk 2 tanggal sejajar -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tgl Surat <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm @error('tgl_surat') is-invalid @enderror" 
                                               name="tgl_surat" value="{{ old('tgl_surat', $disposisi->Tgl_Surat) }}" required>
                                        @error('tgl_surat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tgl Diterima <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm @error('tgl_diterima') is-invalid @enderror" 
                                               name="tgl_diterima" value="{{ old('tgl_diterima', $disposisi->Tgl_Diterima) }}" required>
                                        @error('tgl_diterima')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Row untuk No Agenda dan Sifat sejajar -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No Agenda <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm @error('no_agenda') is-invalid @enderror" 
                                               name="no_agenda" value="{{ old('no_agenda', $disposisi->No_Agenda) }}" required>
                                        @error('no_agenda')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sifat <span class="text-danger">*</span></label>
                                        <select class="form-control form-control-sm @error('sifat') is-invalid @enderror" name="sifat" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Biasa" {{ old('sifat', $disposisi->Sifat) == 'Biasa' ? 'selected' : '' }}>Biasa</option>
                                            <option value="Segera" {{ old('sifat', $disposisi->Sifat) == 'Segera' ? 'selected' : '' }}>Segera</option>
                                            <option value="Sangat Segera" {{ old('sifat', $disposisi->Sifat) == 'Sangat Segera' ? 'selected' : '' }}>Sangat Segera</option>
                                            <option value="Rahasia" {{ old('sifat', $disposisi->Sifat) == 'Rahasia' ? 'selected' : '' }}>Rahasia</option>
                                        </select>
                                        @error('sifat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <!-- Perihal -->
                            <div class="form-group">
                                <label>Perihal <span class="text-danger">*</span></label>
                                <textarea class="form-control form-control-sm @error('perihal') is-invalid @enderror" 
                                          name="perihal" rows="5" required>{{ old('perihal', $disposisi->Perihal) }}</textarea>
                                @error('perihal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Dokumen -->
                            <div class="form-group">
                                <label>Dokumen PDF</label>
                                
                                @if($disposisi->Dokumen)
                                <div class="mb-2">
                                    <small class="text-muted">File saat ini:</small><br>
                                    <a href="{{ asset('uploads/disposisi/' . $disposisi->Dokumen) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="fas fa-file-pdf"></i> Lihat Dokumen
                                    </a>
                                </div>
                                @endif

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('dokumen') is-invalid @enderror" 
                                           id="dokumen" name="dokumen" accept=".pdf">
                                    <label class="custom-file-label" for="dokumen">Pilih file baru (opsional)...</label>
                                    @error('dokumen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="form-text text-muted">Format: PDF, Max: 2MB. Kosongkan jika tidak ingin mengubah dokumen.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                    <a href="{{ route('disposisi.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </div>  
        </div>
    </div>

</form>

<!-- Script untuk menampilkan nama file yang dipilih -->
<script>
document.getElementById('dokumen').addEventListener('change', function(e) {
    var fileName = e.target.files[0].name;
    var label = e.target.nextElementSibling;
    label.textContent = fileName;
});
</script>

@endsection