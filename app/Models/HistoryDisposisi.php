<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryDisposisi extends Model
{
    use HasFactory;

    protected $table = 'history_disposisi';

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
        'catatan',
        'dikirim_oleh',
    ];

    protected $casts = [
        'Tgl_Surat' => 'date',
        'Tgl_Diterima' => 'date',
    ];

    public function disposisi()
    {
        return $this->belongsTo(Disposisi::class, 'nomorsurat', 'nomorsurat');
    }
}