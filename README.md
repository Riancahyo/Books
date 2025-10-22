# Books

**Books** adalah aplikasi berbasis web untuk layanan peminjaman buku perpustakaan digital. Proyek ini dirancang untuk memudahkan pengguna dalam meminjam buku, mengelola peminjaman, dan memberikan pengalaman membaca yang optimal melalui sistem perpustakaan digital yang modern.

## Fitur Utama

- **Registrasi dan Login**: Pengguna dapat membuat akun dan login untuk mengakses layanan perpustakaan.
- **Katalog Buku Digital**: Menampilkan koleksi buku lengkap dengan detail dan kategorisasi.
- **Sistem Peminjaman**: Memungkinkan pengguna untuk meminjam buku secara online.

## Teknologi yang Digunakan

- **Frontend**: HTML, CSS, JavaScript, React.js
- **Backend**: Node.js, Express.js
- **Database**: MySQL
- **Authentication**: JWT (JSON Web Tokens)
- **API Documentation**: Swagger

## Cara Menjalankan Proyek

1. **Clone Repository**

   ```bash
   git clone https://github.com/Riancahyo/Books.git
   cd Books
   ```

2. **Instalasi Dependensi**
   Pastikan Node.js dan npm telah terinstal di sistem Anda, kemudian jalankan:

   ```bash
   npm install
   ```

3. **Konfigurasi Lingkungan**
   Buat file `.env` di root proyek dan tambahkan konfigurasi berikut:

   ```env
   PORT=3306
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=book
   DB_USERNAME=root
   DB_PASSWORD=
   JWT_SECRET=your_jwt_secret_key
   ```

4. **Setup Database**
   ```bash
   npm run migrate
   npm run seed
   ```

5. **Menjalankan Aplikasi**
   Untuk menjalankan aplikasi dalam mode pengembangan:

   ```bash
   npm run dev
   ```

   Aplikasi akan berjalan di `http://localhost:3000`.

## Struktur Proyek

```
Books/
|-- Dokumen/
|-- Project/
|-- README.md
```

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).
