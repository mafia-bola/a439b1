<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';

    protected $guarded = [];

    public function kode()
    {
        return $this->belongsTo(KodeSurat::class);
    }
}
