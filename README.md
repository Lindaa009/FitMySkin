🌸 FitMySkin — Skincare Tracker & Skin Journal

**FitMySkin** adalah aplikasi web untuk melacak rutinitas skincare, mencatat kondisi kulit harian, dan menganalisis kecocokan produk terhadap kulitmu. Dibuat sebagai project kolaborasi dengan fokus pada **analisis korelasi produk vs reaksi kulit**.

![Laravel](https://img.shields.io/badge/Laravel-13.x-red)
![PHP](https://img.shields.io/badge/PHP-8.3-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.x-orange)
![TailwindCSS](https://img.shields.io/badge/Tailwind-3.x-cyan)

**✨ Fitur Utama**
🔐 Autentikasi
- Register & Login dengan email + password
- Session-based authentication (Laravel Auth)
- Edit profil & ganti password
📚 Katalog Produk
- Tambah, edit, hapus produk skincare
- Kategorisasi produk (Cleanser, Toner, Serum, Moisturizer, Sunscreen, Exfoliator)
- Status produk: Aktif / Diistirahatkan
- Filter & search produk
📖 Jurnal Kulit
- Catat jurnal pagi & malam
- Pilih produk yang dipakai + kondisi kulit (Nyaman, Kering, Berminyak, Kemerahan, Perih)
- Tambah catatan & gejala (Gatal, Bruntusan, Mengelupas)
- Riwayat jurnal dengan search & filter
 📊 Analisis Kecocokan
- **Deteksi Produk Pemicu Iritasi** — analisis produk yang dipakai 3 hari sebelum iritasi muncul
- **Streak** — hitung berapa hari berturut-turut user mencatat jurnal
- **Frekuensi kondisi kulit** — persentase kondisi kulit user
- **Smart Warning** — notifikasi cerdas saat produk keras dipakai berlebihan
🎯 Kelola Langkah Skincare
- Atur urutan langkah skincare pagi & malam
- Drag & drop untuk reorder
- Sinkronisasi dengan halaman jurnal (step number otomatis)
🔔 Notifikasi
- Peringatan dini pemicu iritasi
- Pengingat ritual malam
- Streak booster

Export PDF
- Download riwayat jurnal sebagai file PDF

🛠️ Tech Stack
| Layer          | Teknologi                             |
|----------------|-------------------------------------- |
| **Backend**    | Laravel 13, PHP 8.3                   |
| **Database**   | MySQL 8                               |
| **Frontend**   | Blade Template, TailwindCSS (via CDN) |
| **PDF Export** | barryvdh/laravel-dompdf               |
| **Icons**      | Emoji & SVG                           |
| **Fonts**      | Plus Jakarta Sans                     |


📋 Persyaratan Sistem

Sebelum install, pastikan udah ada:

- **PHP** ≥ 8.3
- **Composer** ≥ 2.x
- **MySQL** ≥ 8.0
- **Node.js** (opsional, untuk asset compile)
- **XAMPP / Laragon** (untuk development lokal)

## 📁 Struktur Folder Penting

```
FitMySkin/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php          # Login & Register
│   │   ├── ProductController.php       # CRUD Produk
│   │   ├── JournalController.php       # Jurnal + Export PDF
│   │   ├── AnalisisController.php      # Analisis Streak & Iritasi
│   │   ├── RoutineController.php       # Kelola Langkah
│   │   ├── ProfileController.php       # Profil + Avatar
│   │   ├── DashboardController.php     # Dashboard
│   │   └── NotifikasiController.php    # Notifikasi Cerdas
│   └── Models/
│       ├── User.php
│       ├── Product.php
│       ├── Journal.php
│       └── Routine.php
├── database/
│   └── (migration & seeder)
├── public/
│   ├── css/fitmyskin.css
│   └── js/fitmyskin.js
├── resources/views/
│   ├── layouts/app.blade.php           # Layout utama
│   ├── Jurnal/                         # Halaman jurnal
│   ├── Analisis/                       # Halaman analisis
│   ├── katalog/                        # Halaman katalog
│   ├── auth/                           # Login & register
│   ├── errors/404.blade.php            # Halaman 404
│   └── ...
└── routes/web.php                      # Semua route
```

🗄️ Skema Database

| Tabel              | Fungsi                                                                |
|--------------------|-----------------------------------------------------------------------|
| `users`            | Data user (nama, email, password, tipe kulit, concerns, alergi, foto) |
| `product`          | Produk skincare user (nama, merek, bahan aktif, jenis, jadwal, status)|
| `jurnal`           | Catatan harian (tanggal, kondisi kulit, jadwal, produk, catatan)      |
| `urutan_skincare`  | Urutan langkah rutinitas pagi & malam (JSON)                          |

---

### Dashboard
![Dashboard](screenshots/dashboard.png)

### Analisis Kecocokan
![Analisis](screenshots/analisis.png)
```

---

## 👥 Kontributor

| Nama                    | Peran                   |
|-------------------------|-------                  |
| **Dian Kamilah**        | UI/UX Design            |
| **Raenuha**             | Database Administrator  |
| **Linda Rahmasari**     | Frontend Developer      |
| **Palupi Eka Wardani**  | Frontend Developer      |
| **Siti Komariah**       | Backend Developer       |

---
📄 Lisensi
Project ini dibuat untuk keperluan **tugas akademik**. Tidak untuk penggunaan komersial tanpa izin.


---

<p align="center">
    Dibuat dengan 💖 untuk kulit sehat Indonesia
    <br>
    <b>FitMySkin</b> © 2026
</p>
