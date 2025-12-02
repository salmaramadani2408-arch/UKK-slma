<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    protected $table = 'disposisi';
    protected $primaryKey = 'nomorsurat'; 
    protected $keyType = 'string'; 
    public $incrementing = false;
    public $timestamps = true;  
    
    protected $fillable = [
        'nomorsurat',
        'skpd', 
        'Tgl_Surat', 
        'Perihal', 
        'Tgl_Diterima', 
        'No_Agenda', 
        'Sifat', 
        'Dokumen', 
        'Diteruskan_Ke', 
        'status',
        'dengan_hormat_harap',
        'catatan'
    ];

    protected $casts = [
        'Tgl_Surat' => 'date',
        'Tgl_Diterima' => 'date',
    ];
}