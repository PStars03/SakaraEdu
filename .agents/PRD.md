# PRD.md — SakaraEdu Laravel 13 + Livewire

## 1. Informasi Project

Nama aplikasi: SakaraEdu  
Jenis aplikasi: Website edukasi berbasis Laravel full-stack  
Frontend: Blade + Livewire + Tailwind CSS v4 + Vite 8  
Backend: Laravel 13.x  
Database lokal: MySQL `sakaraedu`  
Database test: SQLite `:memory:`  
Asset bundler: Vite  
CSS framework: Tailwind CSS v4 dengan CSS-first config  
Logo utama: `sakaraedu-logo-horizontal.png`  
Logo ikon: `sakaraedu-logo-icon.png`

SakaraEdu adalah platform web untuk mahasiswa yang menyediakan informasi beasiswa, informasi bootcamp/pelatihan, berita edukasi, serta fitur manajemen uang beasiswa.

## 2. Tujuan Produk

SakaraEdu dibuat untuk membantu mahasiswa:

1. Menemukan informasi beasiswa secara terpusat.
2. Menemukan informasi bootcamp atau pelatihan.
3. Membaca berita dan informasi edukasi.
4. Mengakses link pendaftaran beasiswa dan bootcamp.
5. Mengelola dana beasiswa selama satu semester.
6. Memiliki akun dan profil pribadi.

Untuk pengelola, SakaraEdu menyediakan dashboard Admin dan Super Admin agar konten dapat dikelola sesuai hak akses.

## 3. Target Pengguna

## 3.1 User/Mahasiswa

User dapat:

1. Register akun.
2. Login.
3. Melihat beasiswa.
4. Melihat bootcamp.
5. Membaca berita.
6. Mengedit profil.
7. Menggunakan manajemen uang beasiswa.
8. Klik tombol daftar yang diarahkan ke link eksternal.

## 3.2 Admin

Admin dapat:

1. Login.
2. Membuat beasiswa.
3. Mengedit beasiswa.
4. Membuat bootcamp.
5. Mengedit bootcamp.
6. Membuat berita.
7. Mengedit berita.
8. Mengedit profil pribadi.

Admin tidak dapat menghapus konten.

## 3.3 Super Admin

Super Admin dapat:

1. Login.
2. Membuat admin.
3. Mengedit admin.
4. Menghapus admin.
5. Membuat beasiswa, bootcamp, dan berita.
6. Mengedit semua konten.
7. Menghapus konten beasiswa, bootcamp, dan berita.
8. Mengelola data utama sistem.

## 4. Role dan Hak Akses

| Fitur | User | Admin | Super Admin |
|---|---:|---:|---:|
| Register akun | Ya | Tidak | Tidak |
| Login | Ya | Ya | Ya |
| Logout | Ya | Ya | Ya |
| Melihat beasiswa published | Ya | Ya | Ya |
| Melihat bootcamp published | Ya | Ya | Ya |
| Membaca berita published | Ya | Ya | Ya |
| Klik link pendaftaran | Ya | Opsional | Opsional |
| Mengedit profil sendiri | Ya | Ya | Ya |
| Membuat beasiswa | Tidak | Ya | Ya |
| Mengedit beasiswa | Tidak | Ya | Ya |
| Menghapus beasiswa | Tidak | Tidak | Ya |
| Membuat bootcamp | Tidak | Ya | Ya |
| Mengedit bootcamp | Tidak | Ya | Ya |
| Menghapus bootcamp | Tidak | Tidak | Ya |
| Membuat berita | Tidak | Ya | Ya |
| Mengedit berita | Tidak | Ya | Ya |
| Menghapus berita | Tidak | Tidak | Ya |
| Membuat admin | Tidak | Tidak | Ya |
| Mengedit admin | Tidak | Tidak | Ya |
| Menghapus admin | Tidak | Tidak | Ya |
| Manajemen uang beasiswa | Ya | Tidak | Tidak |

## 5. Modul Aplikasi

## 5.1 Autentikasi

### Kebutuhan

1. User dapat register akun.
2. User, Admin, dan Super Admin dapat login.
3. Sistem mengarahkan pengguna ke dashboard berdasarkan role.
4. Sistem membatasi akses berdasarkan role.
5. User dapat logout.

### Field Register

1. Nama lengkap
2. Email
3. Password
4. Konfirmasi password

### Aturan

1. Role default pendaftar baru adalah `user`.
2. Email harus unik.
3. Password minimal 8 karakter.
4. Password disimpan dalam bentuk hash.

## 5.2 Profil Pengguna

### Field Profil

1. Nama lengkap
2. Email
3. Nomor HP
4. Kampus
5. Program studi
6. Semester
7. Alamat/domisili
8. Foto profil

### Kebutuhan

1. Semua role dapat melihat profil sendiri.
2. Semua role dapat mengedit profil sendiri.
3. Email tetap harus unik.
4. Foto profil bersifat opsional.
5. Form profil disarankan memakai Livewire agar update dan validasi terasa lebih interaktif.

## 5.3 Beasiswa

### Field Beasiswa

1. Judul beasiswa
2. Slug
3. Penyelenggara
4. Tanggal mulai
5. Tanggal berakhir
6. Tempat atau cakupan wilayah
7. Deskripsi
8. Syarat dan ketentuan
9. Benefit
10. Poster
11. Link pendaftaran
12. Status publikasi: `draft` atau `published`
13. Dibuat oleh

### Kebutuhan User

1. User dapat melihat daftar beasiswa berstatus `published`.
2. User dapat mencari beasiswa melalui search Livewire.
3. User dapat melihat detail beasiswa.
4. User dapat melihat poster, tanggal, tempat, deskripsi, syarat, benefit, dan link pendaftaran.
5. User dapat klik tombol "Daftar Sekarang".
6. Tombol "Daftar Sekarang" membuka link eksternal.

### Kebutuhan Admin

1. Admin dapat membuat beasiswa.
2. Admin dapat mengedit beasiswa.
3. Admin tidak dapat menghapus beasiswa.

### Kebutuhan Super Admin

1. Super Admin dapat membuat beasiswa.
2. Super Admin dapat mengedit semua beasiswa.
3. Super Admin dapat menghapus beasiswa.

## 5.4 Bootcamp/Pelatihan

### Deskripsi

Modul bootcamp menampilkan informasi pelatihan atau bootcamp. Bootcamp dapat bersifat gratis atau berbayar.

### Field Bootcamp

1. Judul bootcamp
2. Slug
3. Penyelenggara
4. Tanggal mulai
5. Tanggal berakhir
6. Tempat atau mode pelaksanaan
7. Deskripsi
8. Syarat peserta
9. Materi/kurikulum singkat
10. Poster
11. Link pendaftaran
12. Status publikasi: `draft` atau `published`
13. Tipe biaya: gratis atau berbayar
14. Harga bootcamp
15. Dibuat oleh

### Aturan Harga Bootcamp

1. Jika bootcamp gratis, sistem menampilkan badge atau teks `Free`.
2. Jika bootcamp berbayar, sistem menampilkan harga dalam format Rupiah.
3. Field `price` wajib diisi jika `is_paid = true`.
4. Field `price` harus bernilai `0` atau `null` jika `is_paid = false`.
5. Tampilan harga harus terlihat pada card daftar bootcamp dan halaman detail bootcamp.

### Field Teknis Bootcamp

1. `is_paid` boolean default `false`
2. `price` decimal nullable

### Kebutuhan User

1. User dapat melihat daftar bootcamp berstatus `published`.
2. User dapat mencari bootcamp melalui search Livewire.
3. User dapat memfilter bootcamp berdasarkan:
   - Semua
   - Free
   - Berbayar
4. User dapat melihat detail bootcamp.
5. User dapat melihat label `Free` atau harga bootcamp.
6. User dapat klik tombol "Daftar Sekarang".
7. Tombol daftar membuka link eksternal.

### Kebutuhan Admin

1. Admin dapat membuat bootcamp.
2. Admin dapat mengedit bootcamp.
3. Admin dapat menentukan bootcamp gratis atau berbayar.
4. Jika berbayar, admin wajib mengisi harga.
5. Admin tidak dapat menghapus bootcamp.

### Kebutuhan Super Admin

1. Super Admin dapat membuat bootcamp.
2. Super Admin dapat mengedit semua bootcamp.
3. Super Admin dapat menghapus bootcamp.
4. Super Admin dapat menentukan bootcamp gratis atau berbayar.

## 5.5 Berita

### Field Berita

1. Judul berita
2. Slug
3. Kategori
4. Isi berita
5. Thumbnail
6. Status publikasi: `draft` atau `published`
7. Penulis

### Kebutuhan

1. User dapat melihat daftar berita berstatus `published`.
2. User dapat mencari berita melalui search Livewire.
3. User dapat membaca detail berita.
4. Admin dapat membuat dan mengedit berita.
5. Super Admin dapat membuat, mengedit, dan menghapus berita.

## 5.6 Manajemen Uang Beasiswa

### Deskripsi

Fitur ini membantu user membagi nominal beasiswa selama satu semester. Saat pertama kali membuat rencana dana, user memilih apakah menggunakan transportasi dan apakah membayar kost.

### Asumsi Default

1. Satu semester = 6 bulan.
2. Satu bulan = 30 hari.
3. Total semester = 180 hari.
4. Hasil hitung adalah rekomendasi awal, bukan aturan mutlak.
5. User harus bisa mengedit hasil perhitungan secara manual.

### Input

1. Nominal beasiswa
2. Menggunakan transportasi: ya/tidak
3. Kost: ya/tidak
4. Estimasi biaya transport per hari, opsional
5. Estimasi biaya kost per bulan, opsional

### Output

1. Dana makan per hari
2. Dana transport per hari, jika memakai transport
3. Dana kost per bulan, jika kost
4. Dana tabungan
5. Dana lain-lain
6. Total alokasi
7. Sisa dana

### Livewire Behavior

Fitur ini sangat cocok memakai Livewire karena hasil perhitungan dapat diperbarui langsung tanpa reload halaman.

Kebutuhan interaktif:

1. Saat nominal beasiswa berubah, hasil rekomendasi otomatis diperbarui.
2. Saat toggle transport berubah, komponen transport muncul atau hilang.
3. Saat toggle kost berubah, komponen kost muncul atau hilang.
4. Ringkasan alokasi muncul dalam card animatif.
5. Sistem menampilkan preview sebelum user menyimpan.

## 6. Frontend dan UI/UX

## 6.1 Prinsip Desain

Tema SakaraEdu harus:

1. Simpel.
2. Bersih.
3. Kekinian.
4. Ramah Gen Z.
5. Menggunakan warna dari logo.
6. Memiliki animasi ringan agar tidak monoton.
7. Tetap profesional karena membawa tema pendidikan.

Jangan membuat UI terlalu ramai. Gen Z tidak berarti semua harus neon, bouncing, dan terlihat seperti poster lomba e-sport kampus.

## 6.2 Warna Berdasarkan Logo

Gunakan palet berikut:

| Nama | Hex | Penggunaan |
|---|---|---|
| Primary Blue | `#005F9E` | Navbar, heading, tombol utama |
| Sky Blue | `#12A8E8` | Accent, icon, hover state |
| Deep Navy | `#172B5F` | Teks kuat, sidebar, footer |
| Fresh Green | `#7ACB00` | CTA, badge sukses, aksen panah/progres |
| Dark Green | `#057A2E` | Hover green, status positif |
| Soft Background | `#F8FBFF` | Background halaman |
| White | `#FFFFFF` | Card, navbar, form |
| Slate Text | `#334155` | Body text |

## 6.3 Logo

Gunakan dua logo:

1. `sakaraedu-logo-horizontal.png` untuk navbar, login page, landing page hero, dan footer.
2. `sakaraedu-logo-icon.png` untuk favicon, sidebar collapsed, loading state, dan empty state.

Rekomendasi lokasi file di Laravel:

```text
public/images/sakaraedu-logo-horizontal.png
public/images/sakaraedu-logo-icon.png
```

Contoh penggunaan Blade:

```blade
<img src="{{ asset('images/sakaraedu-logo-horizontal.png') }}" alt="SakaraEdu" class="h-12 w-auto">
```

## 6.4 Tipografi

Rekomendasi font:

1. Gunakan `Inter`, `Plus Jakarta Sans`, atau `Poppins`.
2. Heading boleh menggunakan `Plus Jakarta Sans`.
3. Body text gunakan `Inter`.

Jika tidak ingin menambah dependency font, gunakan font system Tailwind terlebih dahulu.

## 6.5 Style Komponen

### Button Primary

- Background: Primary Blue
- Hover: Deep Navy
- Border radius: rounded-xl atau rounded-2xl
- Shadow halus
- Transisi 200ms

### Button CTA

- Background: Fresh Green
- Hover: Dark Green
- Teks putih
- Cocok untuk tombol "Daftar Sekarang"

### Card

- Background putih
- Rounded-2xl
- Shadow halus
- Border tipis `#E2E8F0`
- Hover naik sedikit dengan transform

### Badge Free

- Background: Fresh Green ringan
- Teks: Dark Green
- Label: `Free`

### Badge Berbayar

- Background: Sky Blue ringan
- Teks: Primary Blue
- Label harga Rupiah

## 6.6 Animasi

Gunakan animasi ringan:

1. Fade in saat halaman dibuka.
2. Slide up untuk card.
3. Hover lift pada card.
4. Pulse lembut pada tombol CTA tertentu.
5. Transition pada sidebar dan dropdown.
6. Loading skeleton untuk daftar data Livewire.

Boleh menggunakan:

1. Tailwind transition utilities.
2. Alpine.js untuk interaksi kecil.
3. Livewire loading states.
4. CSS keyframes sederhana di `resources/css/app.css`.

Jangan gunakan animasi berat yang mengganggu aksesibilitas dan performa.

## 7. Livewire Components

Gunakan Livewire untuk bagian yang membutuhkan interaksi cepat tanpa reload.

### Komponen yang Direkomendasikan

1. `PublicScholarshipList`
2. `PublicBootcampList`
3. `PublicNewsList`
4. `FinancePlanCalculator`
5. `AdminScholarshipTable`
6. `AdminBootcampTable`
7. `AdminNewsTable`
8. `AdminManagementTable`
9. `ProfileForm`

### Perintah Pembuatan

```bash
php artisan make:livewire PublicScholarshipList
php artisan make:livewire PublicBootcampList
php artisan make:livewire PublicNewsList
php artisan make:livewire FinancePlanCalculator
php artisan make:livewire AdminScholarshipTable
php artisan make:livewire AdminBootcampTable
php artisan make:livewire AdminNewsTable
php artisan make:livewire AdminManagementTable
php artisan make:livewire ProfileForm
```

## 8. Struktur Database

## 8.1 users

| Field | Type | Keterangan |
|---|---|---|
| id | bigint | Primary key |
| name | string | Nama |
| email | string unique | Email |
| password | string | Hash password |
| role | string | user, admin, super_admin |
| phone | string nullable | Nomor HP |
| campus | string nullable | Kampus |
| study_program | string nullable | Program studi |
| semester | integer nullable | Semester |
| address | text nullable | Domisili |
| profile_photo | string nullable | Foto profil |
| created_at | timestamp | Otomatis |
| updated_at | timestamp | Otomatis |

## 8.2 scholarships

| Field | Type | Keterangan |
|---|---|---|
| id | bigint | Primary key |
| title | string | Judul |
| slug | string unique | Slug |
| organizer | string | Penyelenggara |
| start_date | date | Mulai |
| end_date | date | Berakhir |
| location | string | Tempat/cakupan |
| description | longText | Deskripsi |
| requirements | longText | Syarat |
| benefits | longText nullable | Benefit |
| poster | string nullable | Path poster |
| registration_link | string | URL daftar |
| status | string | draft, published |
| created_by | foreignId | FK users.id |
| deleted_at | timestamp nullable | Soft delete |
| created_at | timestamp | Otomatis |
| updated_at | timestamp | Otomatis |

## 8.3 bootcamps

| Field | Type | Keterangan |
|---|---|---|
| id | bigint | Primary key |
| title | string | Judul |
| slug | string unique | Slug |
| organizer | string | Penyelenggara |
| start_date | date | Mulai |
| end_date | date | Berakhir |
| location | string | Tempat/mode |
| description | longText | Deskripsi |
| requirements | longText nullable | Syarat |
| curriculum | longText nullable | Materi |
| poster | string nullable | Path poster |
| registration_link | string | URL daftar |
| status | string | draft, published |
| is_paid | boolean | Gratis/berbayar |
| price | decimal(15,2) nullable | Harga jika berbayar |
| created_by | foreignId | FK users.id |
| deleted_at | timestamp nullable | Soft delete |
| created_at | timestamp | Otomatis |
| updated_at | timestamp | Otomatis |

## 8.4 news

| Field | Type | Keterangan |
|---|---|---|
| id | bigint | Primary key |
| title | string | Judul |
| slug | string unique | Slug |
| category | string | Kategori |
| content | longText | Isi |
| thumbnail | string nullable | Thumbnail |
| status | string | draft, published |
| author_id | foreignId | FK users.id |
| deleted_at | timestamp nullable | Soft delete |
| created_at | timestamp | Otomatis |
| updated_at | timestamp | Otomatis |

## 8.5 scholarship_finance_plans

| Field | Type | Keterangan |
|---|---|---|
| id | bigint | Primary key |
| user_id | foreignId | FK users.id |
| scholarship_amount | decimal(15,2) | Nominal beasiswa |
| uses_transport | boolean | Transport |
| uses_rent | boolean | Kost |
| total_months | integer | Default 6 |
| total_days | integer | Default 180 |
| food_percentage | decimal(5,2) | Persentase makan |
| transport_percentage | decimal(5,2) | Persentase transport |
| rent_percentage | decimal(5,2) | Persentase kost |
| saving_percentage | decimal(5,2) | Persentase tabungan |
| other_percentage | decimal(5,2) | Persentase lain |
| food_total | decimal(15,2) | Total makan |
| food_per_day | decimal(15,2) | Makan harian |
| transport_total | decimal(15,2) | Total transport |
| transport_per_day | decimal(15,2) | Transport harian |
| rent_total | decimal(15,2) | Total kost |
| rent_per_month | decimal(15,2) | Kost bulanan |
| saving_total | decimal(15,2) | Tabungan |
| other_total | decimal(15,2) | Lain-lain |
| total_allocation | decimal(15,2) | Total alokasi |
| remaining_balance | decimal(15,2) | Sisa dana |
| created_at | timestamp | Otomatis |
| updated_at | timestamp | Otomatis |

## 9. Validasi

## 9.1 Bootcamp

1. `title` wajib.
2. `organizer` wajib.
3. `start_date` wajib date.
4. `end_date` wajib date dan tidak boleh sebelum `start_date`.
5. `location` wajib.
6. `description` wajib.
7. `registration_link` wajib URL valid.
8. `poster` nullable image JPG/PNG/WEBP max 2MB.
9. `status` wajib `draft` atau `published`.
10. `is_paid` wajib boolean.
11. `price` wajib numeric minimal 1000 jika `is_paid = true`.
12. `price` nullable atau 0 jika `is_paid = false`.

## 10. Struktur Halaman

## 10.1 Halaman Publik

1. `/`
2. `/login`
3. `/register`
4. `/beasiswa`
5. `/beasiswa/{slug}`
6. `/bootcamp`
7. `/bootcamp/{slug}`
8. `/berita`
9. `/berita/{slug}`

## 10.2 Halaman User

1. `/dashboard`
2. `/profile`
3. `/profile/edit`
4. `/uang-beasiswa`
5. `/uang-beasiswa/create`
6. `/uang-beasiswa/{id}`
7. `/uang-beasiswa/{id}/edit`

## 10.3 Halaman Admin

1. `/admin/dashboard`
2. `/admin/beasiswa`
3. `/admin/beasiswa/create`
4. `/admin/beasiswa/{id}/edit`
5. `/admin/bootcamp`
6. `/admin/bootcamp/create`
7. `/admin/bootcamp/{id}/edit`
8. `/admin/berita`
9. `/admin/berita/create`
10. `/admin/berita/{id}/edit`

## 10.4 Halaman Super Admin

1. `/super-admin/dashboard`
2. `/super-admin/admins`
3. `/super-admin/admins/create`
4. `/super-admin/admins/{id}/edit`
5. `/super-admin/beasiswa`
6. `/super-admin/bootcamp`
7. `/super-admin/berita`

## 11. Acceptance Criteria Tambahan

1. Bootcamp gratis tampil dengan label `Free`.
2. Bootcamp berbayar tampil dengan harga Rupiah.
3. Admin wajib mengisi harga jika memilih bootcamp berbayar.
4. User dapat filter bootcamp berdasarkan semua, free, dan berbayar.
5. Frontend menggunakan Blade + Livewire + Tailwind CSS v4.
6. Logo SakaraEdu tampil di navbar, login/register, dashboard, dan footer.
7. Warna UI mengikuti warna logo.
8. Website memiliki animasi ringan pada card, tombol, dropdown, dan loading state.
9. Livewire digunakan untuk pencarian, filter, tabel dashboard, form profil, dan kalkulator uang beasiswa.

## 12. Definition of Done

MVP selesai jika:

1. Semua migration berjalan.
2. Seeder membuat minimal satu Super Admin.
3. Login/register berjalan.
4. Middleware role berjalan.
5. CRUD beasiswa berjalan.
6. CRUD bootcamp berjalan dengan fitur harga/free.
7. CRUD berita berjalan.
8. Kelola admin oleh Super Admin berjalan.
9. Fitur profil berjalan.
10. Fitur manajemen uang beasiswa berjalan dengan Livewire.
11. Search/filter Livewire berjalan untuk beasiswa, bootcamp, dan berita.
12. Logo sudah dipasang.
13. Warna frontend sesuai logo.
14. Animasi ringan berjalan.
15. `composer test` berhasil.
16. `./vendor/bin/pint` tidak menunjukkan masalah style.
17. `npm run build` berhasil.
