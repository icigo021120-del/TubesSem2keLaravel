# Laporan Authentication

## Metode

Authentication dibuat secara manual dengan session Laravel. Pilihan ini mengikuti struktur aplikasi yang sudah tersedia: tabel `users` memakai kolom `nama_lengkap`, `password_hash`, dan `role`, sedangkan aplikasi sudah memiliki halaman login/registrasi serta alur login pengguna dan admin. Cara manual menjaga struktur database dan tampilan yang ada, tanpa mengganti halaman aplikasi dengan scaffolding Breeze. Model `User` tetap menggunakan guard session Laravel melalui middleware `auth`.

## Fitur dan perlindungan halaman

- Registrasi tersedia pada `/registrasi`; email harus unik, kata sandi minimal enam karakter, dan konfirmasi harus cocok.
- Login pengguna tersedia pada `/login`, sedangkan login admin tersedia pada `/admin/login`. Admin dan pengguna biasa tetap dipisahkan berdasarkan `role`.
- Logout menggunakan `POST /logout` dan hanya tersedia bagi pengguna yang sudah login.
- Halaman landing (`/`, `/tentang`, `/fitur`), login, dan registrasi bersifat publik.
- Halaman pengguna (`/beranda`, `/pantauan`, `/peta-risiko`, `/status-sistem`, `/peringatan`, `/notifikasi`, `/rute-evakuasi`, `/titik-kumpul`, `/edukasi`, `/laporan`, `/darurat`, dan `/profil`) dilindungi middleware `auth`.
- Halaman admin di bawah `/admin` dilindungi middleware `auth` dan pemeriksaan role admin.

Validasi ditampilkan pada form dalam bahasa Indonesia. Password tidak disimpan sebagai teks biasa; login memeriksa hash dengan `Hash::check` dan proses registrasi/seeder menyimpan hasil `Hash::make` pada kolom `password_hash`.

## Akun dummy

Seeder `UserSeeder` membuat lima akun mahasiswa dengan nama dan nomor telepon Faker. Seeder tersebut juga dipanggil oleh `DatabaseSeeder`.

| Email | Kata sandi awal | Role |
| --- | --- | --- |
| `dummy01@smartdisaster.test` | `password123` | mahasiswa |
| `dummy02@smartdisaster.test` | `password123` | mahasiswa |
| `dummy03@smartdisaster.test` | `password123` | mahasiswa |
| `dummy04@smartdisaster.test` | `password123` | mahasiswa |
| `dummy05@smartdisaster.test` | `password123` | mahasiswa |

Jalankan `php artisan db:seed --class=UserSeeder` untuk menambahkan akun ke database aktif. Untuk memeriksanya di phpMyAdmin, pilih database aplikasi, buka tabel `users`, lalu pilih **Browse**. Lima email di atas akan terlihat dan kolom `password_hash` berisi hash bcrypt berawalan `$2y$`, bukan `password123`.

Query pemeriksaan opsional di tab SQL phpMyAdmin:

```sql
SELECT nama_lengkap, email, role, password_hash
FROM users
WHERE email LIKE 'dummy%@smartdisaster.test';
```