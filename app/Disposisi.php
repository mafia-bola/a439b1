<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Disposisi
 *
 * @property int $id
 * @property int $dari_user
 * @property int $ke_user
 * @property int $user_surat_id
 * @property string $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Disposisi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Disposisi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Disposisi query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Disposisi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Disposisi whereDariUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Disposisi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Disposisi whereKeUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Disposisi whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Disposisi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Disposisi whereUserSuratId($value)
 * @mixin \Eloquent
 */
class Disposisi extends Model
{
    protected $table= 'disposisi';
    protected $guarded = [];
}
