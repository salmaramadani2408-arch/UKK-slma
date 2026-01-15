<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    // Nama tabel SESUAI database (tanpa underscore)
    protected $table = 'disposisi';
    
    // Primary key adalah nomorsurat (varchar, bukan auto increment)
    protected $primaryKey = 'nomorsurat';
    
    // Key type string (karena nomorsurat adalah varchar)
    protected $keyType = 'string';
    
    // Tidak auto increment (karena nomorsurat diisi manual)
    public $incrementing = false;
    
    // Timestamps
    public $timestamps = true;
    
    // Fillable fields (SESUAI struktur database)
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
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}