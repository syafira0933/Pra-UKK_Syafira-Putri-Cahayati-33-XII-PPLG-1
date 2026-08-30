# DOKUMEN ANALISIS DAN PERANCANGAN SISTEM
## SIMPATIK TAILOR - SISTEM INFORMASI BOOKING JASA JAHIT CUSTOM

---

### 1. ALUR FLOWCHART MANUAL DAN SISTEM

#### A. Deskripsi Flowchart Manual (Operasional Toko Jahit Offline)
Flowchart manual menggambarkan alur fisik interaksi pelanggan yang datang langsung ke toko:
1. **START** - Pelanggan datang ke Simpatik Tailor.
2. **Manual Operation** - Pelanggan menyampaikan kebutuhan & jenis pakaian (Jahit Kustom / Permak).
3. **Manual Operation** - Penjahit melakukan pengukuran fisik badan pelanggan.
4. **Decision (Bawa Kain Sendiri?)**:
   - **YA**: Pelanggan menyerahkan bahan kain fisik ke penjahit.
   - **TIDAK**: Penjahit memperlihatkan & menentukan sample kain dari stok toko.
5. **Manual Operation** - Penjahit mencatat detail pesanan ke dalam buku nota fisik.
6. **Document** - Pencetakan/Penulisan Nota Pesanan Jahit (Bukti Fisik).
7. **Manual Operation** - Penjahit memotong bahan & menjahit pakaian.
8. **Manual Operation** - Pakaian siap diambil & pemeriksaan hasil jahit.
9. **Manual Operation** - Pelanggan melakukan pembayaran fisik & menerima pakaian.
10. **END** - Selesai.

#### B. Deskripsi Flowchart Sistem (Aplikasi Web Laravel)
1. **START** - Akses Landing Page Simpatik Tailor.
2. **Process** - Pilih Menu Booking.
3. **Decision (Isi Form Booking?)**:
   - **YA**: Mengisi Form Booking (Jenis pakaian, jenis layanan, jumlah, tanggal, foto referensi, catatan).
   - **TIDAK**: Kembali ke halaman utama / riwayat.
4. **Decision (Metode Pengukuran?)**:
   - **Di Tempat Pelanggan**: Penjahit datang ke lokasi pelanggan & menginput alamat.
   - **Datang ke Toko**: Penjahit mengukur di toko Simpatik Tailor.
5. **Process** - Form Booking Terkirim & Masuk ke Riwayat Booking (Status: *Menunggu Konfirmasi Admin*).
6. **Process** - Admin Mengonfirmasi Status Pengerjaan (Dikonfirmasi -> Pengukuran Selesai -> Sedang Dijahit -> Siap Diambil -> Selesai).
7. **END** - Selesai.

---

### 2. USE CASE DIAGRAM

#### Aktor:
- **Pelanggan (Customer)**: Pengguna umum yang memesan jasa jahit online.
- **Admin (Penjahit/Pengelola)**: Pengelola sistem dan pengerjaan jahit.

#### Deskripsi Akses Use Case:
- **Pelanggan**: Register, Login, Logout, Melihat Katalog Layanan, Membuat Booking Baru, Melihat Status Pengerjaan, Melihat Riwayat Booking, Kelola Profil.
- **Admin**: Login, Logout, Dashboard Statistik, Kelola Layanan (CRUD), Kelola & Ubah Status Booking, Kelola Jadwal, Melihat Data Pelanggan, Melihat Laporan Transaksi.

---

### 3. CONTEXT DIAGRAM & DATA FLOW DIAGRAM (DFD)

#### A. Context Diagram (Diagram Konteks / DFD Level 0)
- **Pusat Proses**: `0.0 Sistem Booking Simpatik Tailor`
- **Entitas Eksternal**: `PELANGGAN` dan `ADMIN`
- **Aliran Data**:
  - `PELANGGAN` -> `SISTEM`: Data Registrasi, Data Login, Data Booking, Data Profil.
  - `SISTEM` -> `PELANGGAN`: Status Login, Informasi Layanan, Kode Booking, Status Booking, Riwayat.
  - `ADMIN` -> `SISTEM`: Data Login Admin, Data Layanan, Data Jadwal, Update Status Booking.
  - `SISTEM` -> `ADMIN`: Data Booking Masuk, Data Pelanggan, Laporan Booking.

#### B. DFD Level 1
- **1.0 Kelola Akun**: Mengolah pendaftaran & autentikasi (`D1 USERS`).
- **2.0 Kelola Layanan**: Mengolah katalog jenis layanan jahit (`D2 SERVICES`).
- **3.0 Booking**: Mengolah pemesanan booking jahit (`D3 BOOKINGS`).
- **4.0 Kelola Booking**: Mengolah konfirmasi & perubahan status oleh admin (`D3 BOOKINGS`).
- **5.0 Laporan**: Mengolah rekapitulasi data transaksi untuk admin.

#### C. DFD Level 2 (Proses 3.0 Booking)
- `3.1 Isi Detail Pesanan` (Mengambil data layanan dari `D2 SERVICES`).
- `3.2 Cek Ketersediaan Jadwal` (Memeriksa tanggal booking di `D3 BOOKINGS`).
- `3.3 Tentukan Metode Pengukuran` (Pilihan datang ke toko / di lokasi pelanggan).
- `3.4 Simpan Data Booking` (Menyimpan data booking baru ke `D3 BOOKINGS` & memberikan kode booking).

---

### 4. ERD, CDM, DAN PDM

#### A. Entity Relationship Diagram (ERD)
- **Entitas**: `users`, `bookings`, `services`, `admin`.
- **Relasi**:
  - `users` -- < `membuat` > -- `bookings` (1 to N)
  - `admin` -- < `mengelola` > -- `users` (1 to N)
  - `admin` -- < `mengonfirmasi` > -- `bookings` (1 to N)
  - `admin` -- < `mendata` > -- `services` (1 to N)
  - `bookings` -- < `memilih` > -- `services` (N to 1)

#### B. Physical Data Model (PDM) & Structure
- **Relasi Tabel PDM**:
  - Tabel `USERS` memiliki relasi *one-to-many* dengan `BOOKINGS` melalui *foreign key* `user_id` (satu pelanggan dapat membuat banyak booking).
  - Tabel `SERVICES` memiliki relasi *one-to-many* dengan `BOOKINGS` melalui *foreign key* `service_id` (satu jenis layanan dapat dipilih dalam banyak transaksi booking).

1. **`USERS` Table**:
   - `id` (PK, BIGINT 20)
   - `name` (VARCHAR 255)
   - `email` (VARCHAR 255)
   - `phone` (VARCHAR 255)
   - `password` (VARCHAR 255)
   - `role` (ENUM: 'pelanggan', 'admin')
   - `photo` (VARCHAR 255)

2. **`SERVICES` Table**:
   - `id` (PK, BIGINT 20)
   - `name` (VARCHAR 255)
   - `description` (TEXT)
   - `image` (VARCHAR 255)

3. **`BOOKINGS` Table**:
   - `id` (PK, BIGINT 20)
   - `user_id` (FK, BIGINT 20) -> references `USERS.id`
   - `service_id` (FK, BIGINT 20) -> references `SERVICES.id`
   - `booking_code` (VARCHAR 255)
   - `clothing_type` (VARCHAR 255)
   - `other_clothing_type` (VARCHAR 255)
   - `other_service_type` (VARCHAR 255)
   - `quantity` (INT 10)
   - `measurement_method` (ENUM: 'datang_ke_tempat', 'di_tempat_pelanggan')
   - `address` (VARCHAR 255)
   - `booking_date` (DATE)
   - `booking_time` (TIME)
   - `reference_image` (VARCHAR 255)
   - `notes` (TEXT)
   - `status` (ENUM: 'menunggu_konfirmasi', 'dikonfirmasi', 'pengukuran_selesai', 'sedang_dijahit', 'siap_diambil', 'selesai')
