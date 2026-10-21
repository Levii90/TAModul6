# LaporBanjir — Modul 06 Authentication

Aplikasi Laravel untuk menerima laporan banjir warga dan menyediakan pengelolaan laporan yang hanya dapat diakses petugas BPBD Kabupaten Bandung.

## Alasan memilih authentication manual

Authentication dibuat manual tanpa Laravel Breeze agar alur MVC dapat dipelajari dan terlihat jelas: route menerima request, controller memvalidasi data, `Hash` menyimpan password secara aman, `Auth` mengelola login/session, dan middleware `auth` melindungi halaman petugas. Pendekatan yang sama digunakan untuk fitur TA agar autentikasi dan pola kodenya konsisten.

## Akses halaman

| Halaman | Akses |
| --- | --- |
| `/form` dan pengiriman laporan | Publik, tidak perlu login |
| `/laporan/terkirim` | Publik, hanya konfirmasi tanpa menampilkan data warga |
| `/daftar-laporan` | Petugas yang sudah login |
| `/profil-petugas` | Petugas yang sudah login |
| `/login` dan `/register` | Pengguna yang belum login |

## Menjalankan aplikasi

1. Siapkan database MySQL melalui phpMyAdmin dengan nama `db_tamodul6`.
2. Atur koneksi database di `.env` agar mengarah ke database tersebut. Contoh konfigurasi XAMPP:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=db_tamodul6
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Jalankan migrasi dan seeder:

   ```bash
   php artisan migrate --seed
   ```

4. Jalankan aplikasi dan Vite:

   ```bash
   php artisan serve
   npm run dev
   ```

   Buka `http://127.0.0.1:8000`.

## Akun hasil seeder

- Admin BPBD: `admin@bpbd-bandung.go.id` / `BpbdAdmin#2026`
- Petugas dummy: `petugas01@bpbd-bandung.go.id` sampai `petugas05@bpbd-bandung.go.id` / `password`

Seeder menggunakan Faker locale `id_ID`, berjalan idempotent untuk akun sehingga aman dipanggil kembali. Password di tabel `users` disimpan menggunakan `Hash::make()`. Untuk memeriksa melalui phpMyAdmin, buka tabel `users` lalu jalankan query:

```sql
SELECT name, email, password, created_at FROM users;
```

Nilai kolom `password` akan berupa hash, bukan password asli. Seeder juga menambahkan contoh laporan banjir agar halaman petugas langsung berisi data.

## Pengujian alur

1. Buka `/daftar-laporan` sebelum login; middleware mengarahkan ke `/login`.
2. Buka `/form`, kirim laporan tanpa login, dan pastikan konfirmasi berhasil.
3. Login dengan akun admin atau petugas dummy; daftar laporan dapat dibuka.
4. Buka `Profil Petugas` untuk melihat nama, email, dan waktu pembuatan akun.
5. Coba password salah untuk memastikan pesan galat tampil, lalu logout.
6. Register akun baru dan pastikan akun langsung masuk ke halaman daftar laporan.

Test otomatis mencakup proteksi middleware, pelaporan publik, validasi, register, login, logout, dan hash password.
