<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserSurat
 *
 * @property int $id
 * @property int $user_id
 * @property int $surat_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSurat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSurat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSurat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSurat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSurat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSurat whereSuratId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSurat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSurat whereUserId($value)
 * @mixin \Eloquent
 */
class UserSurat extends Model
{
    protected $table = 'user_surat';

    protected $guarded = [];
}
