<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name' => 'E-Pilketos SMA NEGERI 1 PASURUAN',
            'sort_name' => 'E-Pilketos',
            'author' => 'MPK SEWAGATI SMA NEGERI 1 PASURUAN',
            'description' => 'Website pemilihan ketua osis SMA Negeri 1 Pasuruan.',
            'keywords' => 'Pemilu, Pilketos, Pemilihan, OSIS, SMA Negeri 1 Pasuruan, Ketua OSIS, Pemungutan Suara, Siswa, Partisipasi, Pendidikan, Demokrasi, Kegiatan Siswa, Pengembangan Karakter, Pemimpin Muda, Inovasi Siswa',
        ]);
    }
}
