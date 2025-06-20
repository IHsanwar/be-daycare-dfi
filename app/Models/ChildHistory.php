<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildHistory extends Model
{
    use HasFactory;

    protected $table = 'child_history';

    protected $fillable = [
        'child_id',
        'makan_pagi',
        'makan_siang',
        'makan_sore',
        'tanggal',
        'keterangan',
        'nama_pendamping',
        'susu_pagi',
        'susu_siang',
        'susu_sore',
        'air_putih_pagi',
        'air_putih_siang',
        'air_putih_sore',
        'bak_pagi',
        'bak_siang',
        'bak_sore',
        'bab_pagi',
        'bab_siang',
        'bab_sore',
        'tidur_pagi',
        'tidur_siang',
        'tidur_sore',
        'kegiatan_outdoor',
        'kegiatan_indoor',
        'makanan_camilan_pagi',
        'makanan_camilan_siang',
        'makanan_camilan_sore',
        'kondisi',
        'obat_pagi',
        'obat_siang',
        'obat_sore',
        'catatan_buang_air'
    ];

    protected $dates = ['tanggal'];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
