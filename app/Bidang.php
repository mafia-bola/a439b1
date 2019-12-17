<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Bidang
 *
 * @property int $id
 * @property string $nama_bidang
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bidang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bidang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bidang query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bidang whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bidang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bidang whereNamaBidang($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bidang whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Bidang whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bidang extends Model
{
    protected $table = 'bidang';

    protected $guarded = [];
}
