<?php

namespace Database\Seeders;

use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class PortfolioContentSeeder extends Seeder
{
    public function run(): void
    {
        $setting = Setting::query()->first();

        if ($setting) {
            $setting->update(Setting::defaults());
        } else {
            Setting::query()->create(Setting::defaults());
        }

        $admin = User::query()->firstOrCreate(
            ['email' => 'nayla@portfolio.test'],
            [
                'name' => 'Nabila Mutiara Agung Saputri',
                'password' => 'Senyum#2026',
                'email_verified_at' => now(),
            ],
        );
        $admin->update(['name' => 'Nabila Mutiara Agung Saputri']);

        Skill::query()->delete();
        Experience::query()->delete();
        Project::query()->delete();
        Certificate::query()->delete();

        $skills = [
            ['name' => 'Anatomi gigi', 'icon' => 'fa-solid fa-tooth', 'category' => 'dasar'],
            ['name' => 'Morfologi', 'icon' => 'fa-solid fa-shapes', 'category' => 'dasar'],
            ['name' => 'Ilmu dasar', 'icon' => 'fa-solid fa-book-medical', 'category' => 'dasar'],
            ['name' => 'Material gigi', 'icon' => 'fa-solid fa-vial', 'category' => 'dasar'],
            ['name' => 'Pemeriksaan', 'icon' => 'fa-solid fa-user-doctor', 'category' => 'klinik'],
            ['name' => 'Radiografi', 'icon' => 'fa-solid fa-x-ray', 'category' => 'klinik'],
            ['name' => 'Tambal dasar', 'icon' => 'fa-solid fa-notes-medical', 'category' => 'klinik'],
            ['name' => 'Sterilisasi', 'icon' => 'fa-solid fa-shield-heart', 'category' => 'klinik'],
            ['name' => 'Sikat gigi', 'icon' => 'fa-solid fa-book-open', 'category' => 'edukasi'],
            ['name' => 'Komunikasi', 'icon' => 'fa-solid fa-comment-medical', 'category' => 'edukasi'],
            ['name' => 'Jurnal belajar', 'icon' => 'fa-solid fa-file-medical', 'category' => 'edukasi'],
            ['name' => 'Kesehatan gigi', 'icon' => 'fa-solid fa-heart', 'category' => 'edukasi'],
        ];

        foreach ($skills as $index => $skill) {
            Skill::query()->create($skill + [
                'sort_order' => $index + 1,
                'is_visible' => true,
            ]);
        }

        $experiences = [
            ['year' => '2024', 'title' => 'Universitas Jember', 'subtitle' => 'Mahasiswa', 'description' => 'Memulai kuliah Kedokteran Gigi angkatan 2024 di Universitas Jember.', 'image' => 'fa-solid fa-graduation-cap'],
            ['year' => '2024', 'title' => 'Grobogan', 'subtitle' => 'Asal daerah', 'description' => 'Berasal dari Grobogan dan melanjutkan studi Kedokteran Gigi ke Jember.', 'image' => 'fa-solid fa-location-dot'],
            ['year' => '2025', 'title' => 'Ilmu Dasar', 'subtitle' => 'Pembelajaran', 'description' => 'Mengikuti ilmu kedokteran dasar sebagai bekal sebelum keterampilan perawatan gigi.', 'image' => 'fa-solid fa-book-open'],
            ['year' => '2025', 'title' => 'Preklinik', 'subtitle' => 'Praktikum', 'description' => 'Latihan keterampilan di laboratorium kampus, sebelum tahap bertemu pasien.', 'image' => 'fa-solid fa-flask'],
            ['year' => '2026', 'title' => 'Angkatan 2024', 'subtitle' => 'Kedokteran Gigi', 'description' => 'Melanjutkan studi Kedokteran Gigi di Universitas Jember sebagai angkatan 2024.', 'image' => 'fa-solid fa-tooth'],
        ];

        foreach ($experiences as $index => $experience) {
            Experience::query()->create($experience + [
                'sort_order' => $index + 1,
                'is_visible' => true,
            ]);
        }

        $projects = [
            ['year' => '2024', 'title' => 'Catatan Kuliah', 'subtitle' => 'Angkatan 2024', 'description' => 'Catatan belajar Kedokteran Gigi selama kuliah di Universitas Jember.', 'image' => 'fa-solid fa-pen'],
            ['year' => '2024', 'title' => 'Dari Grobogan', 'subtitle' => 'Perjalanan studi', 'description' => 'Cerita berangkat dari Grobogan untuk kuliah Kedokteran Gigi di Jember.', 'image' => 'fa-solid fa-route'],
            ['year' => '2025', 'title' => 'Jurnal Anatomi', 'subtitle' => 'Materi kampus', 'description' => 'Ringkasan anatomi dan morfologi gigi yang dipelajari di laboratorium dan kelas.', 'image' => 'fa-solid fa-tooth'],
            ['year' => '2026', 'title' => 'Senyum Kampus', 'subtitle' => 'Edukasi', 'description' => 'Bahan singkat tentang menjaga kesehatan gigi, dibuat untuk teman di Universitas Jember.', 'image' => 'fa-solid fa-face-smile'],
        ];

        foreach ($projects as $index => $project) {
            Project::query()->create($project + [
                'sort_order' => $index + 1,
                'is_visible' => true,
            ]);
        }

        Certificate::query()->create([
            'year' => '2024',
            'title' => 'Mahasiswa Kedokteran Gigi',
            'issuer' => 'Universitas Jember',
            'description' => 'Mahasiswa Kedokteran Gigi angkatan 2024. Berasal dari Grobogan.',
            'image' => 'fa-solid fa-building-columns',
            'sort_order' => 1,
            'is_visible' => true,
        ]);
    }
};
