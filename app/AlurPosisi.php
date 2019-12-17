<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\AlurPosisi
 *
 * @property-read \App\Alur $alur
 * @property-read \App\Posisi $posisi
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AlurPosisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AlurPosisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\AlurPosisi query()
 * @mixin \Eloquent
 */
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
