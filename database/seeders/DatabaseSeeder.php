<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $stamp = fn (array $rows, string $col = 'created_at') => array_map(fn ($r) => $r + [$col => $now], $rows);

        // Hash bcrypt sama persis dengan dump SQL lama, jadi password akun lama tetap berlaku
        DB::table('users')->insert($stamp([
            ['id' => 1, 'nama_lengkap' => 'Admin Pusat', 'email' => 'admin@telkomuniversity.ac.id', 'no_telepon' => '081234567890', 'role' => 'admin', 'password_hash' => 
            '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'],
            ['id' => 2, 'nama_lengkap' => 'Budi Santoso', 'email' => 'budi@student.telkomuniversity.ac.id', 'no_telepon' => '089876543210', 'role' => 'mahasiswa', 'password_hash' => 
            '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'],
            ['id' => 3, 'nama_lengkap' => 'aisy', 'email' => 'aisy02@gamil.com', 'no_telepon' => '0828378179', 'role' => 'mahasiswa', 'password_hash' => 
            '$2y$10$SEHX.Ar4d3woPZY7k166leMNtvpke..OokMcJJec/AMInmuIjPuFO'],
            ['id' => 4, 'nama_lengkap' => 'Amanaisriz', 'email' => 'admin2@telkomuniversity.ac.id', 'no_telepon' => '0876237278317', 'role' => 'admin', 'password_hash' => 
            '$2y$10$R29Bnu5xiDar0vN6jQBuuO/Vx93fv4LpTWLtfKXZZ0i3ngG1BUF46'],
        ], 'created_at'));

        DB::table('sensors')->insert($stamp([
            ['id' => 1, 'kode_sensor' => 'S-ASAP-TULT-01', 'jenis_sensor' => 'asap', 'lokasi_gedung' => 'Gedung TULT Lantai 5', 'status' => 'aktif'],
            ['id' => 2, 'kode_sensor' => 'S-GEMPA-FIT-01', 'jenis_sensor' => 'gempa', 'lokasi_gedung' => 'Gedung FIT Lantai Dasar', 'status' => 'aktif'],
            ['id' => 3, 'kode_sensor' => 'S-AIR-KU-01', 'jenis_sensor' => 'banjir', 'lokasi_gedung' => 'Area Parkir Kolam', 'status' => 'aktif'],
            ['id' => 4, 'kode_sensor' => 'S-API-FEB-01', 'jenis_sensor' => 'api', 'lokasi_gedung' => 'Gedung FEB Lantai 2', 'status' => 'maintenance'],
        ], 'last_checked'));

        DB::table('alerts')->insert([
            ['sensor_id' => 1, 'tingkat_bahaya' => 'waspada', 'pesan_peringatan' => 'Terdeteksi asap tipis di Gedung TULT Lantai 5. Mohon periksa lokasi.', 'waktu_kejadian' => $now->copy()->subDays(2)],
            ['sensor_id' => 2, 'tingkat_bahaya' => 'siaga', 'pesan_peringatan' => 'Getaran ringan terdeteksi di Gedung FIT. Sistem bersiap siaga.', 'waktu_kejadian' => $now->copy()->subDay()],
        ]);

        DB::table('assembly_points')->insert($stamp([
            ['nama_titik' => 'Titik Kumpul A', 'lokasi' => 'Lapangan Basket Gedung TULT', 'kapasitas' => 500, 'deskripsi' => 'Area lapangan terbuka utama dekat gedung TULT'],
            ['nama_titik' => 'Titik Kumpul B', 'lokasi' => 'Parkir Utama Gedung Rektorat', 'kapasitas' => 800, 'deskripsi' => 'Area parkir luas di depan rektorat'],
            ['nama_titik' => 'Titik Kumpul C', 'lokasi' => 'Taman Kampus Barat', 'kapasitas' => 300, 'deskripsi' => 'Taman hijau terbuka di zona kampus barat'],
        ], 'created_at'));

        DB::table('evacuation_routes')->insert($stamp([
            ['nama_rute' => 'Rute TULT ke Lapangan', 'lokasi_asal' => 'Gedung TULT', 'titik_kumpul' => 'Titik Kumpul A', 'deskripsi' => 'Keluar dari pintu utama, belok kiri, menuju lapangan basket.', 
            'jarak_meter' => 150],
            ['nama_rute' => 'Rute FIT ke Parkir', 'lokasi_asal' => 'Gedung FIT', 'titik_kumpul' => 'Titik Kumpul B', 'deskripsi' => 'Turun tangga darurat, menuju pintu barat, parkir rektorat.', 
            'jarak_meter' => 280],
            ['nama_rute' => 'Rute FEB ke Taman', 'lokasi_asal' => 'Gedung FEB', 'titik_kumpul' => 'Titik Kumpul C', 'deskripsi' => 'Keluar pintu timur, ikuti jalur hijau menuju taman kampus barat.', 
            'jarak_meter' => 200],
        ], 'created_at'));

        DB::table('education_modules')->insert($stamp([
            ['judul' => 'Prosedur Evakuasi Kebakaran', 'kategori' => 'kebakaran', 'konten' => 'Saat alarm kebakaran berbunyi, segera hentikan aktivitas. Jangan gunakan lift. 
            Gunakan tangga darurat yang telah ditandai. 
            Berkumpul di titik kumpul yang sudah ditentukan. Jangan kembali ke gedung sebelum ada izin dari petugas.', 'created_by' => 1],
            ['judul' => 'Tindakan Saat Gempa Bumi', 'kategori' => 'gempa', 'konten' => 'Jika berada di dalam gedung: berlindung di bawah meja yang kuat, lindungi kepala. Jauhi jendela dan benda yang bisa jatuh. 
            Setelah getaran berhenti, 
            segera evakuasi melalui jalur aman. Berkumpul di titik kumpul terdekat.', 'created_by' => 1],
            ['judul' => 'Penanganan Banjir Kampus', 'kategori' => 'banjir', 'konten' => 'Pantau level air secara berkala melalui aplikasi. Jika air mulai naik, segera pindahkan barang-barang berharga ke tempat 
            yang lebih tinggi. Evakuasi ke lantai atas gedung atau titik kumpul yang aman dari banjir.', 'created_by' => 1],
        ], 'created_at'));

        DB::table('reports')->insert([
            ['user_id' => 2, 'deskripsi_kejadian' => 'Ada percikan api dari panel listrik dekat kantin.', 'lokasi_kejadian' => 'Kantin Gedung TULT', 'status_laporan' => 'diproses', 'foto_bukti' => 
            null, 'waktu_lapor' => $now->copy()->subDays(3)],
            ['user_id' => 3, 'deskripsi_kejadian' => 'Banjir selutut yang membuat akses jalan tertutupi', 'lokasi_kejadian' => 'depan Gedung FIT', 'status_laporan' => 'selesai', 'foto_bukti' => 
            null, 'waktu_lapor' => $now->copy()->subDays(2)],
        ]);

        $this->call(UserSeeder::class);
    }
}
