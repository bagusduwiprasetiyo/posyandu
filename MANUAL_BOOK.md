# 📘 MANUAL BOOK
# Sistem Informasi Posyandu Kemuning Lor

**Versi:** 2.0  
**Terakhir Diperbarui:** Agustus 2026  
**Teknologi:** Laravel 5.8 · MySQL · Bootstrap 4

---

## Daftar Isi

1. [Pendahuluan](#1-pendahuluan)
2. [Persyaratan Sistem](#2-persyaratan-sistem)
3. [Instalasi & Konfigurasi](#3-instalasi--konfigurasi)
4. [Hak Akses & Peran Pengguna](#4-hak-akses--peran-pengguna)
5. [Panduan Penggunaan](#5-panduan-penggunaan)
   - 5.1 [Login & Registrasi](#51-login--registrasi)
   - 5.2 [Dashboard](#52-dashboard)
   - 5.3 [Manajemen Kader](#53-manajemen-kader)
   - 5.4 [Pemeriksaan PUS/WUS](#54-pemeriksaan-puswus)
   - 5.5 [Pemeriksaan Ibu Hamil (Bumil)](#55-pemeriksaan-ibu-hamil-bumil)
   - 5.6 [Pemeriksaan Bayi](#56-pemeriksaan-bayi)
   - 5.7 [Deteksi Dini Ibu Hamil — KSPR](#57-deteksi-dini-ibu-hamil--kspr)
   - 5.8 [Konseling](#58-konseling)
   - 5.9 [Rujukan](#59-rujukan)
   - 5.10 [Master Data Posyandu](#510-master-data-posyandu)
   - 5.11 [Standar Antropometri](#511-standar-antropometri)
   - 5.12 [Data Akun Posyandu](#512-data-akun-posyandu)
   - 5.13 [Analisis Posyandu](#513-analisis-posyandu)
   - 5.14 [Laporan Posyandu](#514-laporan-posyandu)
   - 5.15 [SMS Gateway](#515-sms-gateway)
   - 5.16 [Profil Pengguna](#516-profil-pengguna)
   - 5.17 [Portal Ibu (Pengguna Ibu)](#517-portal-ibu-pengguna-ibu)
6. [API Endpoint](#6-api-endpoint)
7. [Riwayat Pembaruan (Changelog 2026)](#7-riwayat-pembaruan-changelog-2026)

---

## 1. Pendahuluan

**Sistem Informasi Posyandu Kemuning Lor** adalah aplikasi berbasis web yang dirancang untuk membantu pengelolaan data dan kegiatan posyandu secara digital. Aplikasi ini mencakup pengelolaan data ibu hamil, bayi, PUS/WUS, deteksi dini risiko kehamilan, konseling kesehatan, sistem rujukan, pelaporan, serta notifikasi melalui SMS Gateway.

### Tujuan Aplikasi

- Mempermudah pencatatan dan pelaporan kegiatan posyandu
- Memantau pertumbuhan bayi dan status gizi berdasarkan standar WHO
- Mendeteksi dini kehamilan berisiko tinggi melalui Kartu Skor Poedji Rochjati (KSPR)
- Menyediakan materi konseling digital berbasis Buku KIA
- Menghasilkan laporan posyandu secara otomatis dalam format PDF
- Memberikan notifikasi dan informasi kepada ibu melalui SMS Gateway

---

## 2. Persyaratan Sistem

### Server

| Komponen       | Minimum                    |
|----------------|----------------------------|
| PHP            | >= 7.1.3                   |
| Database       | MySQL 5.7+                 |
| Web Server     | Apache / Nginx             |
| Composer       | Versi terbaru              |
| Node.js & NPM  | Untuk kompilasi asset      |

### Browser (Client)

- Google Chrome (direkomendasikan)
- Mozilla Firefox
- Microsoft Edge
- Safari

---

## 3. Instalasi & Konfigurasi

### Langkah Instalasi

```bash
# 1. Clone repository
git clone <repository-url> posyandu
cd posyandu

# 2. Install dependensi PHP
composer install

# 3. Install dependensi frontend
npm install

# 4. Salin file konfigurasi
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Konfigurasi database di file .env
#    Sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 7. Jalankan migrasi & seeder
php artisan migrate --seed

# 8. Kompilasi asset frontend
npm run dev

# 9. Jalankan server
php artisan serve
```

### Konfigurasi SMS Gateway

Konfigurasi SMS Gateway dilakukan melalui pengaturan di controller SMS. Pastikan API endpoint SMS pihak ketiga sudah dikonfigurasi dengan benar.

---

## 4. Hak Akses & Peran Pengguna

Sistem memiliki **3 level pengguna** yang dikendalikan oleh field `status` pada tabel `users`:

| Status | Peran     | Deskripsi                                                                 |
|--------|-----------|---------------------------------------------------------------------------|
| **1**  | **Admin** | Akses penuh: kelola master data posyandu, terima/kelola kader, impor data antropometri, buat akun admin, dan seluruh fitur level 2 |
| **2**  | **Kader** | Input data: pemeriksaan (bumil, bayi, PUS/WUS, KSPR), konseling, rujukan, laporan, SMS, kelola akun ibu. Data terbatas pada posyandu masing-masing |
| **3**  | **Ibu**   | Portal baca-saja: melihat data kehamilan sendiri dan data bayi sendiri, serta profil |

### Matriks Akses Menu

| Menu                        | Admin | Kader | Ibu |
|-----------------------------|:-----:|:-----:|:---:|
| Dashboard                   |   ✅   |   ✅   |  ✅  |
| Kader Posyandu              |   ✅   |   ❌   |  ❌  |
| Pemeriksaan (semua sub)     |   ✅   |   ✅   |  ❌  |
| Konseling                   |   ✅   |   ✅   |  ❌  |
| Rujukan                     |   ✅   |   ✅   |  ❌  |
| Master Posyandu             |   ✅   |   ❌   |  ❌  |
| Standar Antropometri        |   ✅   |   ❌   |  ❌  |
| Data Akun Posyandu          |   ✅   |   ✅   |  ❌  |
| Analisis Posyandu           |   ✅   |   ✅   |  ❌  |
| Laporan Posyandu            |   ✅   |   ✅   |  ❌  |
| SMS Gateway                 |   ✅   |   ✅   |  ❌  |
| Data Kehamilan (portal)     |   ❌   |   ❌   |  ✅  |
| Data Bayi (portal)          |   ❌   |   ❌   |  ✅  |
| Profil                      |   ✅   |   ✅   |  ✅  |

---

## 5. Panduan Penggunaan

### 5.1 Login & Registrasi

#### Login

1. Buka halaman utama aplikasi
2. Masukkan **Username** dan **Password**
3. Klik tombol **Login**
4. Sistem akan mengarahkan ke Dashboard sesuai peran pengguna

#### Registrasi Kader

1. Pada halaman utama, klik **Daftar sebagai Kader**
2. Isi formulir registrasi (nama, username, password, nomor telepon, alamat)
3. Pilih posyandu yang akan ditempati
4. Klik **Daftar**
5. Akun berstatus *belum aktif* — menunggu persetujuan Admin

> **Catatan:** Hanya Admin yang dapat menyetujui atau menolak registrasi kader.

---

### 5.2 Dashboard

Dashboard menampilkan ringkasan data posyandu:

- **Jumlah Pasien** terdaftar
- **Jumlah Kader** aktif
- **Jumlah Ibu Hamil** (Bumil)
- **Jumlah Bayi** terdaftar

> Untuk peran Kader, data yang ditampilkan hanya dari posyandu yang bersangkutan.

---

### 5.3 Manajemen Kader

**Akses:** Admin

#### Terima Kader

1. Navigasi ke **Kader Posyandu → Terima Kader**
2. Daftar kader yang mendaftar akan ditampilkan
3. Klik **Terima** untuk mengaktifkan akun kader, atau **Tolak** untuk menolak

#### Data Kader

1. Navigasi ke **Kader Posyandu → Data Kader**
2. Melihat daftar semua kader beserta posyandu yang ditempati
3. Dapat mengedit atau menghapus data kader

---

### 5.4 Pemeriksaan PUS/WUS

**Akses:** Admin, Kader

Menu ini mengelola data **Pasangan Usia Subur (PUS)** dan **Wanita Usia Subur (WUS)**.

#### Tambah Data PUS/WUS

1. Navigasi ke **Pemeriksaan → Pus/Wus**
2. Klik tombol **Tambah Data**
3. Isi formulir:
   - **Data Pribadi:** Nama, NIK, tempat/tanggal lahir, pekerjaan, pendidikan
   - **Data Suami:** Nama suami, pekerjaan suami
   - **Metode KB:** Pilih metode kontrasepsi (Kondom, Pil, Implant, MOP, MOW, UID, Suntik)
   - **Imunisasi:** Status imunisasi TT
   - **LILA:** Lingkar lengan atas
4. Klik **Simpan**

#### Kelola Data

- **Edit:** Klik ikon pensil pada baris data
- **Hapus:** Klik ikon hapus, konfirmasi pada dialog

---

### 5.5 Pemeriksaan Ibu Hamil (Bumil)

**Akses:** Admin, Kader

#### Tambah Data Ibu Hamil

1. Navigasi ke **Pemeriksaan → Ibu Hamil**
2. Klik **Tambah Data**
3. Isi formulir:
   - **Nama Ibu** dan data identitas
   - **Posyandu** (pilih dari dropdown)
   - **Hamil Ke** (kehamilan ke berapa)
   - **LILA** (Lingkar Lengan Atas) — untuk deteksi KEK
   - **Risiko** kehamilan
4. Klik **Simpan**

#### Detail Ibu Hamil

Pada halaman detail, tersedia 3 sub-data yang dapat dikelola:

##### a. Tablet Tambah Darah (TD)

- Mencatat pemberian tablet tambah darah per tanggal
- Klik **Tambah** untuk menambah catatan baru

##### b. Imunisasi TT (Tetanus Toxoid)

- Mencatat status imunisasi TT1 hingga TT5
- Centang imunisasi yang sudah diberikan

##### c. Timbang Bulanan

- Mencatat **berat badan** dan **tekanan darah** ibu hamil setiap bulan
- Pilih **bulan ke-** kehamilan
- Data digunakan untuk memantau pertumbuhan dan risiko

---

### 5.6 Pemeriksaan Bayi

**Akses:** Admin, Kader

#### Tambah Data Bayi

1. Navigasi ke **Pemeriksaan → Bayi**
2. Klik **Tambah Data**
3. Isi formulir:
   - **Nama Bayi**
   - **Tanggal Lahir**
   - **Jenis Kelamin** (L/P)
   - **BB/PB lahir** (berat badan dan panjang badan saat lahir)
   - **Posyandu**
4. Klik **Simpan**

#### Detail Bayi

Pada halaman detail bayi, tersedia 3 sub-data:

##### a. Timbang Bulanan

Pencatatan pertumbuhan bayi setiap bulan:

- **Berat Badan** (kg)
- **Tinggi/Panjang Badan** (cm)
- **Umur** (bulan) — dihitung otomatis
- **Status BB:** Sistem menghitung z-score berdasarkan standar WHO dan mengklasifikasikan:
  - Gizi Buruk (severely underweight)
  - Gizi Kurang (underweight)
  - Normal
  - Gizi Lebih (overweight)
- **Status PB/TB:** Klasifikasi panjang/tinggi badan:
  - Sangat Pendek (severely stunted)
  - Pendek (stunted)
  - Normal
  - Tinggi (tall)
- **Tren:** N (Naik), T1-T3 (Turun 1-3x), O (tetap)

##### b. Obat/Suplemen

Pencatatan pemberian obat dan suplemen:

- **Sirup Fe** (zat besi)
- **Vitamin A**
- **Oralit**
- **PMT** (Pemberian Makanan Tambahan)

##### c. Imunisasi

Pencatatan imunisasi bayi:

- **HBO** (Hepatitis B0)
- **BCG**
- **DPT-HB** (1, 2, 3)
- **Polio** (1, 2, 3, 4)

---

### 5.7 Deteksi Dini Ibu Hamil — KSPR

**Akses:** Admin, Kader

**KSPR (Kartu Skor Poedji Rochjati)** adalah alat skrining untuk mendeteksi dini kehamilan berisiko tinggi.

#### Tambah Skrining KSPR

1. Navigasi ke **Pemeriksaan → Deteksi Dini Bumil (KSPR)**
2. Klik **Tambah Deteksi KSPR Baru**
3. Isi data ibu (dapat dipilih dari data bumil yang sudah ada):
   - Nama, Umur, Pendidikan, Hamil ke
   - Periksa ke, Umur Kehamilan (minggu)
   - Alamat, Kec/Kab, Pekerjaan
   - HPHT (Hari Pertama Haid Terakhir)
   - HPL (Hari Perkiraan Lahir)
4. Pada tabel faktor risiko, centang faktor-faktor yang ditemukan per **tribulan** (trimester):
   - Tribulan I, II, III.1, III.2
5. Skor dihitung otomatis:
   - **Skor Awal:** 2 (semua ibu hamil)
   - Setiap faktor risiko menambah skor sesuai bobotnya

#### Interpretasi Skor

| Total Skor | Kategori | Keterangan |
|:----------:|----------|------------|
| **2–5**    | **KRR** (Kehamilan Risiko Rendah) | Perawatan oleh Bidan, tidak dirujuk, persalinan di rumah/polindes |
| **6–11**   | **KRT** (Kehamilan Risiko Tinggi) | Perawatan oleh Bidan/Dokter, rujuk ke Bidan/Puskesmas |
| **≥ 12**   | **KRST** (Kehamilan Risiko Sangat Tinggi) | Perawatan oleh Dokter, rujuk ke Rumah Sakit |

#### PPA (Perencanaan Persalinan Aman)

Pada data KSPR yang sudah ada, klik ikon **PPA** untuk mengisi:

- **Rujuk dari:** Sendiri / Dukun / Bidan / Puskesmas
- **Rujuk ke:** Bidan / Puskesmas / Rumah Sakit
- **Jenis Rujukan:** RDB / RDR / RTW / RT
- **Gawat Darurat Obstetrik:** Perdarahan antepartum, Eklamsia, dll
- **Komplikasi Obstetrik:** Perdarahan postpartum, Uri tertinggal, Persalinan lama, Panas tinggi
- **Tempat Persalinan:** Rumah Ibu / Bidan / Polindes / Puskesmas / RS
- **Penolong:** Dukun / Bidan / Dokter
- **Macam Persalinan:** Normal / Tindakan Pervaginam / Operasi Sesar
- **Pasca Persalinan Ibu:** Status hidup/mati, penyebab kematian
- **Pasca Persalinan Bayi:** Berat lahir, jenis kelamin, APGAR skor, kelainan bawaan
- **Nifas:** Kondisi ibu selama 42 hari pasca salin
- **KB:** Status keluarga berencana pasca persalinan

---

### 5.8 Konseling

**Akses:** Admin, Kader

Modul konseling menyediakan materi edukasi digital berdasarkan **Buku KIA** (edisi 2020 dan 2024).

#### Cara Menggunakan

1. Navigasi ke menu **Konseling**
2. Pilih kategori konseling:

   | Kategori | Deskripsi |
   |----------|-----------|
   | Ibu Hamil | Panduan kesehatan selama kehamilan |
   | Ibu Bersalin | Panduan menjelang dan saat persalinan |
   | Ibu Nifas | Perawatan pasca melahirkan (42 hari) |
   | Ibu Menyusui | Panduan dan tips menyusui |
   | Keluarga Berencana | Informasi metode kontrasepsi |
   | Kelas Ibu Hamil | Materi kelas ibu hamil |
   | Bayi 0-6 bulan | Perawatan bayi usia 0-6 bulan |
   | Bayi 6-12 bulan | Perawatan bayi usia 6-12 bulan |
   | Anak 12-24 bulan | Perawatan anak usia 12-24 bulan |
   | Anak 2-6 tahun | Perawatan anak usia 2-6 tahun |

3. Klik kategori untuk membuka materi dalam format PDF

---

### 5.9 Rujukan

**Akses:** Admin, Kader

Sistem rujukan mendeteksi secara otomatis kondisi yang memerlukan rujukan:

#### Deteksi Otomatis

| Jenis Rujukan | Kriteria Deteksi |
|---------------|------------------|
| **Bayi Gizi Buruk** | Z-score berat badan terhadap panjang badan (BB/PB) menunjukkan gizi buruk |
| **Bayi Stunting** | Z-score panjang badan terhadap umur (PB/U) menunjukkan stunting |
| **Bumil Risiko Tinggi** | Skor KSPR ≥ 6 |

#### Cara Menggunakan

1. Navigasi ke menu **Rujukan**
2. Sistem menampilkan 3 tab:
   - **Bayi Gizi Buruk** — daftar bayi dengan status gizi buruk
   - **Bayi Stunting** — daftar bayi dengan status stunting
   - **Bumil Risiko Tinggi** — daftar ibu hamil dengan skor KSPR tinggi
3. Tersedia materi referensi tanda bahaya dalam format PDF

---

### 5.10 Master Data Posyandu

**Akses:** Admin

#### Tambah Posyandu

1. Navigasi ke **Master → Tambah Posyandu**
2. Masukkan **Nama Posyandu**
3. Klik **Simpan**

#### Kelola Posyandu

- Daftar posyandu ditampilkan dalam tabel
- Edit atau hapus posyandu melalui tombol aksi

---

### 5.11 Standar Antropometri

**Akses:** Admin

Modul ini mengelola tabel referensi standar pertumbuhan WHO yang digunakan untuk menghitung z-score pada pemeriksaan bayi.

#### Kategori Standar

| Menu | Keterangan |
|------|------------|
| BB Laki-Laki | Standar berat badan menurut umur — anak laki-laki |
| PB Laki-Laki | Standar panjang/tinggi badan menurut umur — anak laki-laki |
| BB Perempuan | Standar berat badan menurut umur — anak perempuan |
| PB Perempuan | Standar panjang/tinggi badan menurut umur — anak perempuan |

#### Impor Data

1. Navigasi ke salah satu sub-menu standar antropometri
2. Unduh **template Excel** yang disediakan
3. Isi data sesuai format template
4. Klik **Impor** dan pilih file Excel
5. Data akan dimasukkan ke tabel referensi

> **Referensi:** Permenkes Tahun 2020 tentang Standar Antropometri Anak

---

### 5.12 Data Akun Posyandu

**Akses:** Admin, Kader

Mengelola akun pengguna dengan peran **Ibu** (status 3):

#### Buat Akun Ibu

1. Navigasi ke **Data Akun Posyandu**
2. Klik **Tambah Akun**
3. Isi data: Nama, Username, Password, No. Telepon, Alamat
4. **Hubungkan** akun dengan data bumil dan/atau data bayi yang sesuai
5. Klik **Simpan**

Ibu yang akunnya sudah dibuat dapat login dan melihat data kehamilan serta data bayinya melalui portal ibu.

---

### 5.13 Analisis Posyandu

**Akses:** Admin, Kader

Modul ini menyediakan grafik dan statistik visual untuk analisis data posyandu.

#### Fitur Analisis

1. **Filter:** Pilih posyandu dan tahun
2. **Grafik Bayi:**
   - Distribusi status berat badan per bulan (gizi kurang / normal / gizi lebih)
   - Distribusi status tinggi badan per bulan (pendek / normal / tinggi)
3. **Grafik Bumil:**
   - Analisis LILA: perbandingan ibu hamil dengan LILA > 23.5 cm (normal) vs ≤ 23.5 cm (KEK/kurang energi kronis)

> Grafik menggunakan **Chart.js** untuk visualisasi interaktif.

---

### 5.14 Laporan Posyandu

**Akses:** Admin, Kader

Tersedia **6 jenis laporan** yang dapat dicetak dalam format PDF menggunakan DomPDF:

| No | Jenis Laporan | Deskripsi |
|----|---------------|-----------|
| 1 | **Laporan Registrasi** | Data registrasi ibu hamil dan bayi |
| 2 | **Laporan PUS/WUS** | Data pasangan/wanita usia subur |
| 3 | **Catatan Ibu Hamil** | Rekam medis ibu hamil |
| 4 | **Hasil Kegiatan** | Rekapitulasi hasil kegiatan posyandu |
| 5 | **Jumlah Pengunjung** | Statistik jumlah pengunjung posyandu |
| 6 | **Laporan Bulanan** | Laporan rekapitulasi bulanan posyandu |

#### Cara Mencetak Laporan

1. Navigasi ke **Laporan Posyandu**
2. Pilih jenis laporan
3. Tentukan filter (posyandu, bulan, tahun) jika tersedia
4. Klik **Cetak** atau **Download PDF**

---

### 5.15 SMS Gateway

**Akses:** Admin, Kader

#### Kontak

1. Navigasi ke **SMS Gateway → Kontak**
2. Tambah, edit, atau hapus kontak penerima SMS
3. Data kontak: Nama, Nomor Telepon

#### Kirim SMS

1. Navigasi ke **SMS Gateway → Kirim SMS**
2. Pilih penerima dari daftar kontak
3. Tulis isi pesan
4. Klik **Kirim**
5. Riwayat pengiriman dapat dilihat pada halaman yang sama

> SMS dikirim melalui API pihak ketiga menggunakan HTTP client (Guzzle).

---

### 5.16 Profil Pengguna

**Akses:** Semua pengguna

1. Navigasi ke menu **Profil**
2. Dapat melihat dan mengedit data profil:
   - Nama
   - Username
   - Email
   - Nomor Telepon
   - Alamat
   - Password (opsional, jika ingin mengubah)
3. Klik **Simpan** untuk menyimpan perubahan

---

### 5.17 Portal Ibu (Pengguna Ibu)

**Akses:** Ibu (status 3)

Portal khusus untuk ibu yang sudah dibuatkan akun oleh Kader/Admin.

#### Data Kehamilan

- Menampilkan data kehamilan yang terhubung dengan akun ibu
- Informasi: nama, hamil ke, LILA, risiko, detail timbang, imunisasi TT, tablet tambah darah

#### Data Bayi

- Menampilkan data bayi yang terhubung dengan akun ibu
- Informasi: nama bayi, tanggal lahir, jenis kelamin
- Detail: riwayat timbang, status gizi, imunisasi, obat/suplemen

---

## 6. API Endpoint

Sistem menyediakan beberapa API endpoint untuk integrasi atau akses data secara programatis:

| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| `POST` | `/api/auth` | Login API — mengembalikan data autentikasi dalam format JSON |
| `GET` | `/api/rujukan/bayi-gizi-buruk` | Daftar bayi dengan status gizi buruk |
| `GET` | `/api/rujukan/bayi-stunting` | Daftar bayi dengan status stunting |
| `GET` | `/api/rujukan/bumil-risiko-tinggi` | Daftar ibu hamil dengan risiko tinggi (KSPR ≥ 6) |

---

## 7. Riwayat Pembaruan (Changelog 2026)

### 📅 13 Agustus 2026

**Perbaikan Modul Rujukan & Detail Bayi**

- Refaktor controller rujukan (`RujukanController`) — optimasi query dan penyederhanaan logika
- Penyempurnaan halaman detail bayi (`bayi/detail`) — penambahan informasi yang lebih lengkap
- Peningkatan tampilan halaman rujukan (`rujukan/index`) — UI lebih informatif
- Penambahan endpoint API rujukan baru

### 📅 11 Agustus 2026

**Fitur Rujukan Lengkap & Standar BB/PB**

- Penambahan fitur rujukan otomatis secara signifikan pada controller (`RujukanController`) — deteksi bayi gizi buruk, bayi stunting, dan bumil risiko tinggi
- Penambahan dokumen referensi: *Permenkes Tahun 2020 tentang Standar Antropometri Anak* (PDF)
- Penambahan template Excel untuk impor data standar antropometri BB/PB/TB
- Pengembangan halaman detail bayi dengan grafik dan informasi pertumbuhan yang lebih komprehensif
- Pengembangan halaman rujukan dengan 3 tab kategori (gizi buruk, stunting, bumil risiko tinggi)
- Penambahan 2 endpoint API rujukan (`bayi-gizi-buruk`, `bayi-stunting`)

### 📅 29 Juli 2026

**Modul Konseling, Rujukan, KSPR & Pembersihan Keamanan**

- **Modul Konseling baru:** Penambahan halaman konseling (`konseling/index`, `konseling/show`) dengan materi Buku KIA 2020 dan 2024 dalam format PDF viewer
- **Modul Rujukan baru:** Halaman rujukan awal (`rujukan/index`) untuk menampilkan data rujukan
- Penambahan file referensi: *Buku KIA 2020 Bagian Ibu* dan *Buku KIA 2024* (PDF)
- Pembaruan besar pada tampilan data bayi (`bayi/index`, `bayi/detail`) — peningkatan UX dan informasi
- Pembaruan tampilan data bumil — perbaikan form input (create, edit, detail, index)
- Pembaruan tampilan dan form KSPR — penyempurnaan skrining per tribulan
- Pembaruan tampilan data PUS/WUS — perbaikan form input dan layout
- Penambahan menu Konseling dan KSPR pada sidebar navigasi
- **Pembersihan Keamanan:** Penghapusan file-file berbahaya hasil *web shell injection* dari direktori `public/` (40+ file malware dihapus)
- Update dependensi Composer (`composer.lock`)

### 📅 21 Juli 2026

**Fitur KSPR (Kartu Skor Poedji Rochjati)**

- **Modul KSPR baru:** Penambahan fitur Deteksi Dini Ibu Hamil menggunakan metode Kartu Skor Poedji Rochjati
- Controller KSPR (`KSPRController`) — CRUD lengkap dengan skrining faktor risiko per tribulan
- Halaman daftar KSPR (`kspr/index`) — tabel data skrining dengan skor
- Halaman form KSPR (`kspr/create`) — formulir skrining komprehensif dengan:
  - Autofill dari data ibu hamil yang sudah ada
  - Tabel faktor risiko dengan checklist per tribulan
  - Perhitungan skor otomatis
  - Tabel PPA (Perencanaan Persalinan Aman)
  - Form hasil persalinan dan pasca persalinan
- Penambahan controller PPA KSPR (`PPAKSPRController`)
- Penambahan menu KSPR di sidebar navigasi
- Penambahan 7 route baru untuk fitur KSPR
- **Pembersihan Keamanan:** Penghapusan 40+ file *web shell / malware* dari direktori `public/` yang diinjeksi oleh pihak tidak bertanggung jawab

---

## Catatan Tambahan

### Keamanan

- Selalu gunakan password yang kuat untuk semua akun
- Lakukan backup database secara berkala
- Pastikan server menggunakan HTTPS
- Monitor direktori `public/` untuk mencegah injeksi file berbahaya
- Perbarui dependensi secara berkala

### Dukungan

Untuk pertanyaan atau kendala teknis, hubungi administrator sistem.

---

*Dokumen ini dibuat secara otomatis berdasarkan analisis fitur aplikasi dan riwayat git.*  
*Terakhir diperbarui: Agustus 2026*
