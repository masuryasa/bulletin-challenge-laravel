# TIMEDOOR TRAINING CHALLENGE PROGRAM - LARAVEL

## FEATURE

- Login
- Register
- Attach files (image)

## REVISION

### 1

- Simpan image ke dalam database cukup nama file-nya saja, tidak perlu nama direktori-nya :heavy_check_mark:
- Bisa edit post yang tidak ada password nya dari post lain dengan ganti id nya di inspect element, cek delete nya juga. Perbaiki validasi. :heavy_check_mark:
- Enter di dalam textarea harus terbaca dan tersimpan di database sebagai baris baru :heavy_check_mark:
- Tampilkan pesan error pada saat password tidak valid :heavy_check_mark:
- Gunakan default picture pada form edit, jika bulletin tidak memiliki picture :heavy_check_mark:
- Tambahkan validasi password (bukan penggantian password) pada saat akan submit pada form edit :heavy_check_mark:
- Pada register confirmation, tampilkan plain password bukan hasil hashing :heavy_check_mark:
- User yang belum verified tidak dapat melakukan post bulletin :heavy_check_mark:
- Jangan tampilkan input password pada form edit jika user sudah login (+verified) :heavy_check_mark:

### 2

- Login user validation agar tidak bisa melakukan update/delete message user lain (dari inspect element) :heavy_check_mark:
- Gunakan html5 standart structure :heavy_check_mark:
- Rapikan atribute html pada blade :heavy_check_mark:
- `is_null()` vs `isset()` :heavy_check_mark:

### 3

- Data yang dapat dikirim dari controller jangan ditempatkan di blade :heavy_check_mark:
- Elemen hasil `foreach()` lebih mudah dibaca dan lebih efisien jika langsung digunakan tanpa disimpan ke variable :heavy_check_mark:
- Jangan mengulang banyak kode (tag html) pada blade, manfaatkan pengkondisian :heavy_check_mark:

### 4

- Jangan append nama path image dengan string di blade :heavy_check_mark:
- Jangan explode DateTime pada field created_at, gunakan DateTime format :heavy_check_mark:
- Gunakan method `hasFile()` agar safety jika seandainya file tidak ada :heavy_check_mark:
- Tahun copyright dengan function `date('Y')` :heavy_check_mark:
- Efisiensi penggunaan query pada model :heavy_check_mark:
- Gunakan `hasFile()` untuk mengecek apakah input memiliki file :heavy_check_mark:
- Jangan assign FK (Foreign Key) secara hardcode, gunakan method `associate()` :heavy_check_mark:
- Gunakan method `destroy()` untuk delete model berdasarkan id, dan delete image jadikan method `deleteImages()` --- DRY :heavy_check_mark:
- Berikan action `error` response AJAX :heavy_check_mark:
- Sederhanakan validasi isMember :heavy_check_mark:
- Operator `==` dijadikan `===` :heavy_check_mark:
- Penamaan variable buat lebih jelas/eksplisit, seperti `$emailVerifiedNull` jadi `$isEmailVerified` :heavy_check_mark:
