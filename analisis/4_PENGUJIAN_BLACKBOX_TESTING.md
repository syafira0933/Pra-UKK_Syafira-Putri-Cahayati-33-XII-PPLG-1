# TABEL PENGUJIAN BLACK BOX TESTING
## SIMPATIK TAILOR - SISTEM INFORMASI BOOKING JASA JAHIT CUSTOM

---

| No | Fitur Yang Diuji | Skenario / Langkah Pengujian | Masukan (Input) | Hasil Yang Diharapkan | Hasil Pengujian | Kesimpulan |
| :-: | :--- | :--- | :--- | :--- | :-: | :-: |
| **1** | **Registrasi Pelanggan** | Mengisi form pendaftaran akun baru pelanggan | Nama, Email, No HP, Password | Akun baru berhasil dibuat & otomatis redirect ke dashboard | Sesuai Harapan | 🟢 **Valid** |
| **2** | **Login Pengguna** | Mengisi email & password yang sudah terdaftar | Email & Password terdaftar | Pengguna berhasil masuk ke sistem sesuai role (Pelanggan/Admin) | Sesuai Harapan | 🟢 **Valid** |
| **3** | **Lihat Katalog Layanan** | Menampilkan daftar jenis layanan jahit di homepage | Klik menu *"Layanan"* | Menampilkan gambar, nama, & deskripsi layanan jahit | Sesuai Harapan | 🟢 **Valid** |
| **4** | **Tambah Booking Baru** | Mengisi formulir booking pemesanan jahit | Jenis Pakaian, Layanan, Jumlah, Tanggal, Pengukuran | Pesanan booking berhasil tersimpan & mendapatkan Kode Booking | Sesuai Harapan | 🟢 **Valid** |
| **5** | **Validasi Kuota Jadwal** | Memilih tanggal booking yang kuotanya sudah penuh | Memilih tanggal yang penuh | Sistem menampilkan notifikasi peringatan kuota penuh | Sesuai Harapan | 🟢 **Valid** |
| **6** | **Lihat Status & Riwayat** | Menampilkan status pengerjaan jahit pelanggan | Klik menu *"Riwayat Booking"* | Menampilkan daftar booking & status pengerjaan (*Menunggu/Dijahit/Selesai*) | Sesuai Harapan | 🟢 **Valid** |
| **7** | **Filter & Cari Booking (Admin)** | Mengetikkan nama/kode booking pada pencarian admin | Kata kunci pencarian & filter status | Menampilkan data booking yang cocok dengan kunci pencarian | Sesuai Harapan | 🟢 **Valid** |
| **8** | **Update Status Pengerjaan (Admin)** | Mengubah status pengerjaan di halaman detail admin | Memilih status baru (*misal: Sedang Dijahit*) | Status booking berhasil diperbarui & pelanggan dapat melihat hasilnya | Sesuai Harapan | 🟢 **Valid** |
| **9** | **Kelola Layanan Jahit (Admin)** | Menambah & mengedit katalog layanan jahit | Nama Layanan, Deskripsi, Foto | Layanan baru berhasil tampil di katalog depan | Sesuai Harapan | 🟢 **Valid** |
| **10** | **Hapus Booking (Admin)** | Menghapus data booking yang dibatalkan | Klik tombol *"Hapus Booking"* | Data booking terhapus permanen dari database | Sesuai Harapan | 🟢 **Valid** |
| **11** | **Logout Akun** | Keluar dari sesi login aplikasi | Klik tombol *"Log Out"* | Sesi login berakhir & pengguna kembali ke halaman utama | Sesuai Harapan | 🟢 **Valid** |
