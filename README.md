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
