<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\HistoryDisposisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisposisiController extends Controller
{
    public function index()
    {
        $disposisi = Disposisi::orderBy('created_at', 'desc')->get();
        
        return view('disposisi.index', compact('disposisi'));
    }

    public function create()
    {
        return view('disposisi.create');
    }

    public function show($nomorsurat)
    {
        $nomorsurat = urldecode($nomorsurat);
        $disposisi = Disposisi::where('nomorsurat', $nomorsurat)->firstOrFail();
        
    
        return redirect()->route('admin.disposisi.edit', urlencode($nomorsurat));
    }

    public function store(Request $request)
{
    $request->validate([
        'nomor_surat' => 'required|string|max:255|unique:disposisi,nomorsurat',
        'skpd' => 'required|string|max:255',
        'tgl_surat' => 'required|date',
        'tgl_diterima' => 'required|date',
        'perihal' => 'required|string',
        'no_agenda' => 'required|string|max:255',
        'sifat' => 'required|in:Biasa,Segera,Sangat Segera,Rahasia',
        'dokumen' => 'required|file|mimes:pdf|max:2048',
    ]);

    // Handle file upload
    $filename = null;
    if ($request->hasFile('dokumen')) {
        $file = $request->file('dokumen');
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\.]/', '_', $file->getClientOriginalName());
        $file->move(public_path('uploads/disposisi'), $filename);
    }


    $action = $request->input('action', 'save');

    if ($action === 'send') {
        
        HistoryDisposisi::create([
            'nomorsurat' => $request->nomor_surat,
            'skpd' => $request->skpd,
            'Tgl_Surat' => $request->tgl_surat,
            'Tgl_Diterima' => $request->tgl_diterima,
            'Perihal' => $request->perihal,
            'No_Agenda' => $request->no_agenda,
            'Sifat' => $request->sifat,
            'Dokumen' => $filename,
            'Diteruskan_Ke' => 'Kepala Badan',
            'status' => 'terkirim',
        ]);

        return redirect()->route('admin.disposisi.index')
            ->with('success', 'Surat berhasil dikirim langsung ke Kaban!');
    } else {

        Disposisi::create([
            'nomorsurat' => $request->nomor_surat,
            'skpd' => $request->skpd,
            'Tgl_Surat' => $request->tgl_surat,
            'Tgl_Diterima' => $request->tgl_diterima,
            'Perihal' => $request->perihal,
            'No_Agenda' => $request->no_agenda,
            'Sifat' => $request->sifat,
            'Dokumen' => $filename,
            'Diteruskan_Ke' => 'Kepala Badan',
            'status' => 'pending',
        ]);

        return redirect()->route('admin.disposisi.index')
            ->with('success', 'Data disposisi berhasil disimpan!');
    }
}
    public function edit($nomorsurat)
    {
        $nomorsurat = urldecode($nomorsurat);
        $disposisi = Disposisi::where('nomorsurat', $nomorsurat)->firstOrFail();
        return view('disposisi.edit', compact('disposisi'));
    }

    public function update(Request $request, $nomorsurat)
    {
        $nomorsurat = urldecode($nomorsurat);
        
        $request->validate([
            'nomor_surat' => 'required|string|max:255|unique:disposisi,nomorsurat,' . $nomorsurat . ',nomorsurat',
            'skpd' => 'required|string|max:255',
            'tgl_surat' => 'required|date',
            'tgl_diterima' => 'required|date',
            'perihal' => 'required|string',
            'no_agenda' => 'required|string|max:255',
            'sifat' => 'required|in:Biasa,Segera,Sangat Segera,Rahasia',
            'dokumen' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $disposisi = Disposisi::where('nomorsurat', $nomorsurat)->firstOrFail();
        
        
        $nomorsuratLama = $disposisi->nomorsurat;
        
        
        if ($request->hasFile('dokumen')) {
            
            if ($disposisi->Dokumen && file_exists(public_path('uploads/disposisi/' . $disposisi->Dokumen))) {
                unlink(public_path('uploads/disposisi/' . $disposisi->Dokumen));
            }

            $file = $request->file('dokumen');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\.]/', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/disposisi'), $filename);
            
            $disposisi->Dokumen = $filename;
        }

        
        $disposisi->nomorsurat = $request->nomor_surat;
        $disposisi->skpd = $request->skpd;
        $disposisi->Tgl_Surat = $request->tgl_surat;
        $disposisi->Tgl_Diterima = $request->tgl_diterima;
        $disposisi->Perihal = $request->perihal;
        $disposisi->No_Agenda = $request->no_agenda;
        $disposisi->Sifat = $request->sifat;
        
        $disposisi->save();


        if ($nomorsuratLama !== $request->nomor_surat) {
            HistoryDisposisi::where('nomorsurat', $nomorsuratLama)
                ->update(['nomorsurat' => $request->nomor_surat]);
        }

        return redirect()->route('admin.disposisi.index')
            ->with('success', 'Data disposisi berhasil diupdate!');
    }

   public function kirim($nomorsurat)
{
    $nomorsurat = urldecode($nomorsurat);
    
    try {
        // Ambil data disposisi
        $disposisi = Disposisi::where('nomorsurat', $nomorsurat)->firstOrFail();
        
        // Cek apakah sudah ada di history
        $sudahAda = HistoryDisposisi::where('nomorsurat', $nomorsurat)->exists();
        
        if ($sudahAda) {
            return redirect()->route('admin.disposisi.index')
                ->with('error', 'Surat ini sudah pernah dikirim!');
        }
        
        
        $historySaved = HistoryDisposisi::create([
            'nomorsurat' => $disposisi->nomorsurat,
            'skpd' => $disposisi->skpd,
            'Tgl_Surat' => $disposisi->Tgl_Surat,
            'Tgl_Diterima' => $disposisi->Tgl_Diterima,
            'Perihal' => $disposisi->Perihal,
            'No_Agenda' => $disposisi->No_Agenda,
            'Sifat' => $disposisi->Sifat,
            'Dokumen' => $disposisi->Dokumen,
            'Diteruskan_Ke' => $disposisi->Diteruskan_Ke,
            'status' => 'terkirim',
        ]);
        
        
        if (!$historySaved) {
            return redirect()->route('admin.disposisi.index')
                ->with('error', 'Gagal menyimpan ke history!');
        }
        
    
        $disposisi->delete();
        
        return redirect()->route('admin.disposisi.index')
            ->with('success', 'Surat berhasil dikirim ke Kaban dan History!');
            
    } catch (\Exception $e) {
        
        return redirect()->route('admin.disposisi.index')
            ->with('error', 'Gagal mengirim surat: ' . $e->getMessage());
    }
}

    public function destroy($nomorsurat)
    {
        $nomorsurat = urldecode($nomorsurat);
        $disposisi = Disposisi::where('nomorsurat', $nomorsurat)->firstOrFail();
        
        // Hapus file dokumen
        if ($disposisi->Dokumen && file_exists(public_path('uploads/disposisi/' . $disposisi->Dokumen))) {
            unlink(public_path('uploads/disposisi/' . $disposisi->Dokumen));
        }
        
        // Hapus data disposisi
        $disposisi->delete();
        
        return redirect()->route('admin.disposisi.index')
            ->with('success', 'Data disposisi berhasil dihapus!');
    }
}