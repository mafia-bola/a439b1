<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlurPosisi extends Model
{
    protected $table = 'alur_posisi';
    protected $guarded = [];

    public function alur()
    {
        return $this->belongsTo(Alur::class);
    }

    public function posisi()
    {
        return $this->belongsTo(Posisi::class);
    }
}
