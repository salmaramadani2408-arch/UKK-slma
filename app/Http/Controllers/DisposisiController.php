<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disposisi = Disposisi::all();
        return view('disposisi.index', ['disposisi'=>$disposisi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('disposisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nomor_surat' => 'required|string|max:255|unique:_disposisi,nomorsurat',
        'skpd' => 'required|string|max:255',
        'tgl_surat' => 'required|date',
        'perihal' => 'required|string',
        'tgl_diterima' => 'required|date',
        'no_agenda' => 'required|string|max:255',
        'sifat' => 'required|in:Biasa,Segera,Sangat Segera,Rahasia',
        'dokumen' => 'required|file|mimes:pdf|max:2048',
        'diteruskan_ke' => 'required|string',
    ]);

    $file = $request->file('dokumen');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('uploads/disposisi'), $filename);

    Disposisi::create([
        'nomorsurat' => $request->nomor_surat,
        'skpd' => $request->skpd,
        'Tgl_Surat' => $request->tgl_surat,
        'Perihal' => $request->perihal,
        'Tgl_Diterima' => $request->tgl_diterima,
        'No_Agenda' => $request->no_agenda,
        'Sifat' => $request->sifat,
        'Dokumen' => $filename,
        'Diteruskan_Ke' => $request->diteruskan_ke,
        'Dengan_Hormat_Harap' => null,  
        'Catatan' => null,          
    ]);

    return redirect()->route('disposisi.index')
                     ->with('success', 'Data disposisi berhasil disimpan');
}    /**
     * Display the specified resource.
     */
    public function show(Disposisi $disposisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nomorsurat)
    {
        $disposisi = Disposisi::where('nomorsurat', $nomorsurat)->firstOrFail();
        return view('disposisi.edit', compact('disposisi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nomorsurat)
{
    // Validasi input
    $request->validate([
        'nomor_surat' => 'required|string|max:255',
        'skpd' => 'required|string|max:255',
        'tgl_surat' => 'required|date',
        'tgl_diterima' => 'required|date',
        'no_agenda' => 'required|string|max:255',
        'sifat' => 'required|in:Biasa,Segera,Sangat Segera,Rahasia',
        'perihal' => 'required|string',
        'dokumen' => 'nullable|file|mimes:pdf|max:2048',
    ]);

    $disposisi = Disposisi::where('nomorsurat', $nomorsurat)->firstOrFail();
    
    $disposisi->nomorsurat = $request->nomor_surat;
    $disposisi->skpd = $request->skpd;
    $disposisi->Tgl_Surat = $request->tgl_surat;
    $disposisi->Tgl_Diterima = $request->tgl_diterima;
    $disposisi->No_Agenda = $request->no_agenda;
    $disposisi->Sifat = $request->sifat;
    $disposisi->Perihal = $request->perihal;
    $disposisi->Diteruskan_Ke = $request->diteruskan_ke;
    

    if ($request->hasFile('dokumen')) {
        if ($disposisi->Dokumen && file_exists(public_path('uploads/disposisi/' . $disposisi->Dokumen))) {
            unlink(public_path('uploads/disposisi/' . $disposisi->Dokumen));
        }

        $file = $request->file('dokumen');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/disposisi'), $filename);
        $disposisi->Dokumen = $filename;
    }

    $disposisi->save();

    return redirect()->route('disposisi.index')
                     ->with('success', 'Data disposisi berhasil diupdate!');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disposisi $disposisi)
    {
        if ($disposisi->Dokumen && file_exists(public_path('uploads/disposisi/' . $disposisi->Dokumen))) {
            unlink(public_path('uploads/disposisi/' . $disposisi->Dokumen));
        }

        Disposisi::where('nomorsurat', $disposisi->nomorsurat)->delete();
        return redirect('disposisi')->with('success', 'Data disposisi berhasil dihapus');
    }
}