<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';

    protected $fillable = [
        'no_surat',
        'kode_surat_id',
        'kategori',
        'tipe',
        'kategori',
        'judul',
        'keterangan',
        'file_surat',
        'status'
    ];

    public function kodeSurat()
    {
        return $this->belongsTo(KodeSurat::class);
    }
}
