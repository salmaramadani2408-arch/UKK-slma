<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;

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
        ->with('success', 'Data disposisi berhasil ditambahkan!');
}

    public function edit($nomorsurat)
    {
        $disposisi = Disposisi::where('nomorsurat', $nomorsurat)->firstOrFail();
        return view('disposisi.edit', compact('disposisi'));
    }

    public function update(Request $request, $nomorsurat)
    {
        $request->validate([
            'nomor_surat' => 'required|string|max:255',
            'skpd' => 'required|string|max:255',
            'tgl_surat' => 'required|date',
            'tgl_diterima' => 'required|date',
            'perihal' => 'required|string',
        ]);

    $disposisi = Disposisi::where('nomorsurat', $nomorsurat)->firstOrFail();
    
    // Handle file upload jika ada file baru
    if ($request->hasFile('dokumen')) {
        // Hapus file lama
        if ($disposisi->Dokumen && file_exists(public_path('uploads/disposisi/' . $disposisi->Dokumen))) {
            unlink(public_path('uploads/disposisi/' . $disposisi->Dokumen));
        }

        // Upload file baru
        $file = $request->file('dokumen');
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\.]/', '_', $file->getClientOriginalName());
        $file->move(public_path('uploads/disposisi'), $filename);
        
        $disposisi->Dokumen = $filename;
    }

    // Update data lainnya
    $disposisi->nomorsurat = $request->nomor_surat;
    $disposisi->skpd = $request->skpd;
    $disposisi->Tgl_Surat = $request->tgl_surat;
    $disposisi->Tgl_Diterima = $request->tgl_diterima;
    $disposisi->Perihal = $request->perihal;
    $disposisi->No_Agenda = $request->no_agenda;
    $disposisi->Sifat = $request->sifat;
    
    $disposisi->save();

    return redirect()->route('admin.disposisi.index')
        ->with('success', 'Data disposisi berhasil diupdate!');
}
    public function destroy($nomorsurat)
    {
        $disposisi = Disposisi::where('nomorsurat', $nomorsurat)->firstOrFail();
        $disposisi->delete();

        return redirect()->route('admin.disposisi.index')
            ->with('success', 'Data disposisi berhasil dihapus!');
    }
}