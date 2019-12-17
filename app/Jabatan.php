<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Jabatan
 *
 * @property int $id
 * @property string $nama_jabatan
 * @property string $eselon
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Jabatan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Jabatan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Jabatan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Jabatan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Jabatan whereEselon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Jabatan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Jabatan whereNamaJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Jabatan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Jabatan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Jabatan extends Model
{
    protected $table = 'jabatan';

    protected $guarded = [];
}
