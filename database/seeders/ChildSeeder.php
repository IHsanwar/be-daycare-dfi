<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChildSeeder extends Seeder
{
    public function run()
    {
        DB::table('children')->insert([
            [
                'user_id' => 1, // Adjust with an actual user ID
                'nama' => 'John Doe',
                'makan_pagi' => 'Nasi + Telur',
                'makan_siang' => 'Ayam + Sayur',
                'makan_sore' => 'Susu + Roti',
                'sudah_minum_obat' => true,
                'tanggal' => Carbon::now(),
                'keterangan' => 'Anak sehat dan aktif',
                'nama_pendamping' => 'Jane Doe',
                'susu_pagi' => 200,
                'susu_siang' => 250,
                'susu_sore' => 150,
                'air_putih_pagi' => 100,
                'air_putih_siang' => 150,
                'air_putih_sore' => 200,
                'bak_pagi' => 1,
                'bak_siang' => 1,
                'bak_sore' => 0,
                'bab_pagi' => 1,
                'bab_siang' => 0,
                'bab_sore' => 0,
                'tidur_pagi' => 60,
                'tidur_siang' => 120,
                'tidur_sore' => 30,
                'kegiatan_outdoor' => json_encode(['Bermain di taman', 'Sepeda']),
                'kegiatan_indoor' => json_encode(['Mewarnai', 'Membaca buku']),
                'makanan_camilan_pagi' => 'Buah',
                'makanan_camilan_siang' => 'Biskuit',
                'makanan_camilan_sore' => 'Sereal',
                'kondisi' => 'Sehat',
                'obat_pagi' => 'Vitamin C',
                'obat_siang' => null,
                'obat_sore' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
