# Product Requirement Document (PRD)

## Project Name
**SakaraEdu (Version 3.0)**

> Sistem Informasi Manajemen Beasiswa & Asisten Finansial Mahasiswa Berbasis AI

---

# Informasi Dokumen

| Informasi | Detail |
|-----------|--------|
| **Nama Proyek** | SakaraEdu |
| **Versi** | 3.0 |
| **Penulis** | Petrix Yoga Eka Pradivtia |
| **NIM / Kelas** | 19241560 / 19.4A.18 |
| **Program Studi** | Sistem Informasi |
| **Institusi** | Universitas Bina Sarana Informatika (UBSI) |
| **Tanggal** | Juni 2026 |
| **Status** | Draft / Disetujui untuk Pengembangan |

---

# 1. Ringkasan Proyek (Project Overview)

## 1.1 Latar Belakang

SakaraEdu berawal dari kebutuhan sistem informasi untuk menjembatani penyaluran beasiswa pendidikan. Namun, untuk menghindari risiko etika dan regulasi terkait pengelolaan dana langsung (*holding money*), sistem ini berevolusi.

SakaraEdu v3.0 kini bertransformasi menjadi platform edukasi dan pendamping finansial mahasiswa yang utuh. Platform ini menggabungkan pencocokan beasiswa transparan dengan dua alat bantu kecerdasan buatan (AI):

- AI Semester Advisor
- Sakara QuickLog AI

---

## 1.2 Tujuan Sistem

### Fasilitator Transparan

Memfasilitasi pendaftaran dan seleksi beasiswa internal kampus tanpa menyentuh aliran dana transaksi secara langsung.

### Edukasi Finansial Semester

Membantu mahasiswa memetakan target keuangan selama 6 bulan ke depan menggunakan Generative AI.

### QuickLog AI

Mempermudah pencatatan pemasukan dan pengeluaran harian menggunakan Natural Language Processing (NLP).

---

# 2. Pengguna Sistem (User Personas)

| Role | Deskripsi |
|------|-----------|
| **Mahasiswa** | Pengguna utama. Dapat mendaftar beasiswa, menggunakan AI Advisor, dan mencatat transaksi harian. |
| **Sponsor / Donor** | Membuat program beasiswa dan mengunggah bukti transfer. |
| **Admin / Tim Seleksi** | Memvalidasi pendaftar serta mengelola sistem. |

---

# 3. Ruang Lingkup (Scope of Work)

## In Scope

### Modul Manajemen Beasiswa

- CRUD Program Beasiswa
- Upload Persyaratan
- Seleksi Administrasi
- Upload Bukti Transfer

### Modul AI Semester Advisor

- Perhitungan biaya semester
- Analisis AI
- Export PDF

### Modul QuickLog AI

- Input Natural Language
- Parsing JSON
- Penyimpanan transaksi otomatis

### Dashboard

- Status Beasiswa
- Ringkasan Keuangan
- Grafik Harian
- Grafik Bulanan

---

## Out of Scope

- Payment Gateway
- Midtrans
- Xendit
- Dompet Digital
- Open Banking API

---

# 4. Workflow Sistem

## 4.1 Workflow Beasiswa

```text
Admin
   │
   ▼
Membuat Program
   │
   ▼
Mahasiswa Mendaftar
   │
   ▼
Upload Dokumen
   │
   ▼
Validasi Admin
   │
   ├── Accepted
   │      │
   │      ▼
   │ Transfer Offline
   │      │
   │      ▼
   │ Upload Bukti Transfer
   │
   └── Rejected
```

---

## 4.2 Workflow AI Semester Advisor

```text
Input Data
    │
    ▼
Backend Hitung
    │
    ▼
Generate Prompt
    │
    ▼
Gemini API
    │
    ▼
Analisis AI
    │
    ▼
Dashboard
```

---

## 4.3 Workflow QuickLog AI

```text
Input:
"Beli makan 15rb dan parkir 2rb"

        │
        ▼

Groq API

        │
        ▼

JSON

[
  {
    "type":"keluar",
    "amount":15000,
    "category":"Makanan"
  },
  {
    "type":"keluar",
    "amount":2000,
    "category":"Transportasi"
  }
]

        │
        ▼

Insert Database
        │
        ▼

Dashboard Update
```

---

# 5. Functional Requirements

## Modul A — Manajemen Beasiswa

### FR-A1

Sistem menyediakan CRUD Program Beasiswa.

### FR-A2

Status pendaftaran:

- Pending
- Accepted
- Rejected

### FR-A3

Donor dapat mengunggah bukti transfer.

---

## Modul B — AI Semester Advisor

### FR-B1

Rumus perhitungan:

```text
Total Pengeluaran =
UKT +
(Biaya Hidup × 6)
```

### FR-B2

Contoh Prompt AI

```text
Berikan analisis finansial mahasiswa jurusan Sistem Informasi dengan kebutuhan Rp11.200.000.

Berikan:
- 3 tips hemat
- rekomendasi beasiswa
- peluang freelance
```

---

## Modul C — QuickLog AI

### FR-C1

Input:

```text
Beli kopi 18rb dan parkir 2rb
```

### FR-C2

Output JSON

```json
[
  {
    "type":"keluar",
    "amount":18000,
    "category":"Konsumsi"
  },
  {
    "type":"keluar",
    "amount":2000,
    "category":"Transportasi"
  }
]
```

---

# 6. Non Functional Requirements

## UI / UX

- Modern Minimalist
- White Space
- Rounded Corner
- Soft Shadow
- Pastel Color

## Performance

| Komponen | Target |
|----------|--------|
| Login | < 2 detik |
| Dashboard | < 2 detik |
| QuickLog AI | < 3 detik |
| AI Semester | < 5 detik |

## Security

- HTTPS
- JWT
- SQL Injection Protection
- API Key di `.env`
- Decimal(12,2)

---

# 7. Database

## scholarships

```sql
CREATE TABLE scholarships (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    provider_name VARCHAR(150),
    due_date DATE
);
```

## daily_transactions

```sql
CREATE TABLE daily_transactions (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    transaction_type ENUM('masuk','keluar'),
    amount DECIMAL(12,2),
    category VARCHAR(50),
    description VARCHAR(255),
    created_at TIMESTAMP
);
```

---

# 8. Acceptance Criteria

- Tidak ada fitur transaksi uang.
- AI Advisor memberikan rekomendasi sesuai jurusan.
- QuickLog mampu memecah satu kalimat menjadi beberapa transaksi.
- Dashboard otomatis diperbarui tanpa refresh.

---

# 9. Teknologi

## Frontend

- Flutter
- Riverpod
- Material 3

## Backend

- Laravel 12
- REST API

## Database

- MySQL

## AI

- Gemini API
- Groq API

---

# 10. Roadmap

| Tahapan | Durasi |
|----------|--------|
| Analisis | 1 Minggu |
| UI/UX | 2 Minggu |
| Backend | 3 Minggu |
| AI Integration | 2 Minggu |
| Frontend | 3 Minggu |
| Testing | 2 Minggu |
| Deployment | 1 Minggu |