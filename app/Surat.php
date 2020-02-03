<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Surat
 *
 * @property int $id
 * @property string $no_surat
 * @property int $kode_surat_id
 * @property string $kategori
 * @property string $tipe
 * @property string $judul
 * @property string $keterangan
 * @property string $file_surat
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\KodeSurat $kodeSurat
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat whereFileSurat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat whereKategori($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat whereKodeSuratId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat whereNoSurat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat whereTipe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Surat whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        'posisi_surat',
        'keterangan',
        'file_surat',
        'status'
    ];

    public function kodeSurat()
    {
        return $this->belongsTo(KodeSurat::class);
    }
}
