<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\KodeSurat
 *
 * @property int $id
 * @property string $kode_surat
 * @property string $keterangan
 * @property int|null $parent_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KodeSurat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KodeSurat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KodeSurat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KodeSurat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KodeSurat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KodeSurat whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KodeSurat whereKodeSurat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KodeSurat whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\KodeSurat whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class KodeSurat extends Model
{
    protected $table = 'kode_surat';

    protected $guarded = [];
}
