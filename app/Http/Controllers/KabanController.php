<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disposisi;
use App\Models\HistoryDisposisi;

class KabanController extends Controller
{
    public function dashboard()
    {
        return view('kaban.dashboard');
    }
    
    public function suratmasuk()
    {
        
        $disposisi = HistoryDisposisi::where('status', 'terkirim')
            ->orderBy('Tgl_Diterima', 'desc')
            ->get();
        
        return view('kaban.suratmasuk.index', compact('disposisi'));
    }
    
    public function show($nomorsurat)
    {
        
        $disposisi = HistoryDisposisi::where('nomorsurat', $nomorsurat)->firstOrFail();
        return view('kaban.suratmasuk.show', compact('disposisi'));
    }
    
    public function edit($nomorsurat)
    {
        
        $disposisi = HistoryDisposisi::where('nomorsurat', $nomorsurat)->firstOrFail();
        return view('kaban.suratmasuk.edit', compact('disposisi'));
    }
    
    public function update(Request $request, $nomorsurat)
    {
        $request->validate([
            'Diteruskan_Ke' => 'required|string',
            'status' => 'required|in:terkirim,diterima,selesai',
            'dengan_hormat_harap' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);
        
    
        $disposisi = HistoryDisposisi::where('nomorsurat', $nomorsurat)->firstOrFail();
        

        $disposisi->Diteruskan_Ke = $request->Diteruskan_Ke;
        $disposisi->status = $request->status;
        $disposisi->dengan_hormat_harap = $request->dengan_hormat_harap;
        $disposisi->catatan = $request->catatan;
        $disposisi->save();
        
        return redirect()->route('kaban.suratmasuk')->with('success', 'Disposisi berhasil diperbarui!');
    }
}