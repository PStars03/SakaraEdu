# PRD — SakaraEdu v2.0
## Platform Informasi Pendidikan, Manajemen Beasiswa, dan AI Student Financial Advisor

---

# 1. Ringkasan Proyek (Project Overview)

## 1.1 Latar Belakang

SakaraEdu awalnya dirancang sebagai platform informasi pendidikan dan manajemen beasiswa yang mempertemukan pihak donor (kampus maupun eksternal) dengan mahasiswa yang membutuhkan bantuan dana.

Namun, modul pengelolaan keuangan langsung (transaksi atau holding money) dinilai tidak etis dan memiliki risiko tinggi terhadap regulasi keuangan.

Oleh karena itu, **SakaraEdu v2.0** mendesain ulang tata kelola keuangan dengan menghapus seluruh modul transaksi fisik.

Sebagai gantinya, aspek finansial diselesaikan melalui dua pendekatan yang lebih etis:

- **Fasilitator Data**
  - Sistem hanya mencatat, memverifikasi bukti transfer manual, dan mencocokkan kelayakan.

- **AI Financial Advisor**
  - Fitur edukatif berbasis Generative AI untuk membantu mahasiswa merencanakan biaya kuliah dan biaya hidup selama satu semester secara mandiri.

---

## 1.2 Tujuan Sistem

Sistem bertujuan untuk:

- Mengotomatisasi proses publikasi, pendaftaran, dan seleksi beasiswa internal kampus.
- Menyediakan pusat informasi pendidikan dan beasiswa yang transparan.
- Meningkatkan literasi keuangan mahasiswa melalui AI Student Financial Advisor.
- Menjamin keamanan, privasi data sensitif, dan kepatuhan terhadap etika sistem informasi.

---

# 2. Pengguna Sistem (User Personas)

| Role | Deskripsi | Hak Akses |
|-------|-----------|-----------|
| **Mahasiswa** | Pengguna utama yang mencari beasiswa dan membutuhkan perencanaan biaya kuliah | Melihat beasiswa, mendaftar beasiswa, mengisi AI Financial Planner, melihat hasil analisis AI |
| **Donor / Sponsor** | Alumni, perusahaan, atau kampus yang menyediakan dana beasiswa | Membuat posting beasiswa, melihat statistik pendaftar, mengunggah bukti transfer |
| **Admin / Tim Seleksi** | Dosen atau staf kampus yang mengelola sistem | Memvalidasi pendaftaran, menentukan penerima beasiswa, mengelola konten |

---

# 3. Ruang Lingkup Sistem (Scope of Work)

## 3.1 In Scope

### Modul Informasi Beasiswa

- Manajemen pengumuman beasiswa
- Upload syarat administrasi
- Tracking status pendaftaran

### Modul Seleksi Kelayakan

- Penilaian administrasi
- Scoring
- Validasi penerima

### Modul AI Student Financial Advisor

- Input estimasi biaya kuliah
- Perhitungan kebutuhan biaya satu semester
- Analisis AI menggunakan Generative AI
- Tips pengelolaan keuangan

### Modul Verifikasi Manual

- Upload bukti transfer donor
- Validasi dokumen
- Dokumentasi transparansi penyaluran dana

---

## 3.2 Out of Scope

Sistem **tidak menyediakan**:

- Payment Gateway
- Dompet Digital
- Saldo Internal
- Transfer uang
- Virtual Account
- Pencairan dana otomatis

---

# 4. Workflow Sistem

## 4.1 Workflow Manajemen Beasiswa

```text
Donor/Admin
      │
      ▼
Membuat Program Beasiswa
      │
      ▼
Mahasiswa Melihat Informasi
      │
      ▼
Mahasiswa Mendaftar
      │
      ▼
Upload Dokumen
      │
      ▼
Admin Review
      │
      ├── Accepted
      │       │
      │       ▼
      │ Donor Transfer Langsung
      │       │
      │       ▼
      │ Upload Bukti Transfer
      │
      └── Rejected
```

---

## 4.2 Workflow AI Student Financial Advisor

```text
Mahasiswa Login
      │
      ▼
Menu AI Advisor
      │
      ▼
Input Data Finansial
      │
      ▼
Backend Menghitung
      │
      ▼
Generate Prompt
      │
      ▼
Gemini API
      │
      ▼
AI Response
      │
      ▼
Dashboard Analisis
```

---

# 5. Functional Requirements

# Modul A — Manajemen Beasiswa

## FR-A1

Sistem harus menampilkan daftar beasiswa aktif yang dapat difilter berdasarkan:

- Jenis
- Deadline
- Penyelenggara
- Jenjang Pendidikan

---

## FR-A2

Sistem menyediakan formulir pendaftaran yang mendukung upload:

- PDF
- JPG
- PNG

Dokumen meliputi:

- KHS
- Slip Gaji
- Surat Keterangan
- Transkrip
- Dokumen Pendukung

---

## FR-A3

Admin dapat mengubah status menjadi:

- Pending
- Review
- Accepted
- Rejected

---

## FR-A4

Donor dapat mengunggah bukti transfer sebagai bentuk transparansi.

---

# Modul B — AI Student Financial Advisor

## FR-B1

Mahasiswa mengisi data berikut:

- Program Studi
- UKT/SPP
- Biaya Kos per Bulan
- Biaya Konsumsi
- Biaya Transportasi
- Dana Mandiri

---

## FR-B2

Backend menghitung:

### Total Pengeluaran

```math
Total Pengeluaran =
UKT +
(Biaya Kos × 6) +
(Biaya Hidup × 6)
```

### Selisih Dana

```math
Selisih =
Dana Mandiri -
Total Pengeluaran
```

---

## FR-B3

Backend otomatis membuat Prompt AI.

Contoh Prompt:

```text
Berikan analisis keuangan terstruktur untuk mahasiswa jurusan [Jurusan] dengan total kebutuhan satu semester sebesar [Total Pengeluaran] dan mengalami [Status Selisih].

Berikan:

- 3 tips efisiensi anggaran
- rekomendasi bantuan kampus
- 2 peluang kerja paruh waktu yang sesuai jurusan.
```

---

## FR-B4

Dashboard mahasiswa menampilkan hasil AI menggunakan Markdown.

Disediakan tombol:

- Cetak PDF
- Simpan Riwayat

---

# 6. Non Functional Requirements

## Ethics & Legality

Sistem **tidak boleh**:

- Menyimpan PIN
- Menyimpan CVV
- Memproses transaksi bank
- Menyimpan saldo pengguna

Sistem hanya bertindak sebagai:

- Record Keeper
- Verification System

---

## Security

Data sensitif harus:

- Masking pada Frontend
- AES-256 Encryption
- API Key disimpan di `.env`

---

## Performance

Target performa:

| Komponen | Target |
|----------|--------|
| Login | < 2 detik |
| Dashboard | < 3 detik |
| AI Response | < 5 detik |
| Upload Dokumen | < 10 detik |

---

# 7. Arsitektur Database

## scholarships

```sql
CREATE TABLE scholarships (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    description TEXT,
    provider_name VARCHAR(150),
    due_date DATE
);
```

---

## scholarship_applications

```sql
CREATE TABLE scholarship_applications (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    scholarship_id INT,
    status ENUM(
        'Pending',
        'Review',
        'Accepted',
        'Rejected'
    ),
    proof_of_transfer VARCHAR(255) NULL,

    FOREIGN KEY (user_id)
        REFERENCES users(id),

    FOREIGN KEY (scholarship_id)
        REFERENCES scholarships(id)
);
```

---

## ai_semester_planners

```sql
CREATE TABLE ai_semester_planners (

    id INT PRIMARY KEY AUTO_INCREMENT,

    user_id INT,

    major VARCHAR(100),

    ukt_fee DECIMAL(10,2),

    monthly_living_cost DECIMAL(10,2),

    current_savings DECIMAL(10,2),

    ai_response_text TEXT,

    created_at TIMESTAMP,

    FOREIGN KEY(user_id)
    REFERENCES users(id)

);
```

---

# 8. Contoh Response Backend AI

```json
{
  "status": "success",
  "message": "Analisis AI berhasil dibuat",
  "data": {
    "student_id": 19241560,
    "calculation": {
      "total_budget_needed": 11200000,
      "available_funds": 6000000,
      "status": "Defisit Rp 5.200.000"
    },
    "ai_advice": "### Hasil Rekomendasi Finansial SakaraEdu AI\n\n1. Strategi Efisiensi\n2. Peluang Kerja Sampingan\n3. Solusi Alternatif Kampus"
  }
}
```

---

# 9. Acceptance Criteria

## Skenario Beasiswa

- Admin membuat beasiswa.
- Mahasiswa dapat mendaftar.
- Upload dokumen berhasil.
- Admin melakukan review.
- Donor mengunggah bukti transfer.
- Tidak terdapat broken link maupun error database.

---

## Skenario AI Advisor

- Semua input tervalidasi.
- Backend menghitung kebutuhan biaya.
- AI memberikan respons.
- Markdown berhasil dirender.
- PDF dapat dicetak.

---

## Skenario Keamanan

Hasil audit menunjukkan:

- API Key tersimpan di `.env`
- Tidak ada penyimpanan data PIN
- Tidak ada penyimpanan CVV
- Tidak ada proses transaksi bank
- Data finansial terenkripsi menggunakan AES-256

---

# 10. Teknologi yang Direkomendasikan

## Frontend

- Flutter
- Material 3
- Riverpod / Provider
- Lottie Animation
- Markdown Renderer

## Backend

- Laravel 12
- REST API
- JWT Authentication

## Database

- MySQL 8

## Cloud Storage

- Supabase Storage
- AWS S3 (Opsional)

## AI

- Gemini API

## PDF

- Flutter PDF Package

## Authentication

- JWT
- OAuth Google

---

# 11. Target Pengembangan

| Tahapan | Estimasi |
|----------|----------|
| UI/UX | 2 Minggu |
| Backend API | 2 Minggu |
| AI Integration | 1 Minggu |
| Testing | 1 Minggu |
| Deployment | 1 Minggu |

Total estimasi pengembangan adalah **7 minggu**.