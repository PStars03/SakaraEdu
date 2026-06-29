<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Scholarship;
use App\Models\Bootcamp;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create seed users
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@sakaraedu.com'],
            [
                'name'      => 'Super Admin',
                'password'  => bcrypt('password123'),
                'role'      => 'super_admin',
                'is_active' => true,
            ]
        );

        $admin = User::firstOrCreate(
            ['email' => 'admin@sakaraedu.com'],
            [
                'name'      => 'Admin SakaraEdu',
                'password'  => bcrypt('password123'),
                'role'      => 'admin',
                'is_active' => true,
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@sakaraedu.com'],
            [
                'name'      => 'Budi Santoso',
                'password'  => bcrypt('password123'),
                'role'      => 'user',
                'is_active' => true,
            ]
        );

        // =====================================================
        // 1. DUMMY BEASISWA (10 data)
        // =====================================================
        $scholarships = [
            [
                'title'             => 'Beasiswa Pendidikan Indonesia (BPI) 2026',
                'organizer'         => 'Kementerian Pendidikan, Kebudayaan, Riset dan Teknologi',
                'location'          => 'Seluruh Indonesia',
                'description'       => "Beasiswa Pendidikan Indonesia (BPI) adalah program beasiswa bergengsi yang didanai langsung oleh pemerintah Indonesia melalui Kemendikbudristek. Program ini dirancang untuk mendukung putra-putri terbaik bangsa agar bisa mengenyam pendidikan tinggi di dalam maupun luar negeri.\n\nBeasiswa ini mencakup biaya pendidikan penuh (UKT/SPP), biaya hidup bulanan, biaya buku, asuransi kesehatan, dan tiket pulang-pergi bagi penerima yang berkuliah di luar negeri. Setiap tahun, ribuan mahasiswa terpilih dari seluruh pelosok Indonesia mendapatkan kesempatan emas ini.",
                'requirements'      => "1. Warga Negara Indonesia (WNI)\n2. Tidak sedang mendapatkan beasiswa lain\n3. IPK minimal 3.00 (skala 4.00) untuk program S1\n4. IPK minimal 3.25 untuk program S2/S3\n5. Usia maksimal 35 tahun untuk S2 dan 40 tahun untuk S3\n6. Memiliki kemampuan bahasa Inggris (TOEFL iBT min 61 / IELTS 6.0)\n7. Surat rekomendasi dari institusi/dosen pembimbing\n8. Essay motivasi dan rencana kontribusi pasca studi",
                'benefits'          => "✅ Biaya pendidikan penuh (bebas UKT/SPP)\n✅ Tunjangan hidup Rp 3.500.000/bulan\n✅ Biaya buku dan penelitian\n✅ Biaya transportasi\n✅ Asuransi kesehatan selama masa studi\n✅ Biaya tiket PP (untuk penerima luar negeri)",
                'registration_link' => 'https://beasiswa.kemdikbud.go.id',
                'status'            => 'published',
                'poster'            => 'https://picsum.photos/seed/sch1/800/500',
            ],
            [
                'title'             => 'Google Generation Scholarship 2026',
                'organizer'         => 'Google Indonesia',
                'location'          => 'Online (Seluruh Indonesia)',
                'description'       => "Google Generation Scholarship adalah program beasiswa dari Google yang khusus ditujukan bagi mahasiswa IT/Informatika yang memiliki passion di bidang teknologi dan inovasi. Program ini tidak hanya memberikan dukungan finansial, tetapi juga akses ke jaringan profesional Google yang eksklusif.\n\nPenerima beasiswa akan mendapatkan kesempatan magang di kantor Google di Asia Tenggara, sesi mentoring dengan engineer Google, serta undangan ke Google developer events eksklusif.",
                'requirements'      => "1. Mahasiswa aktif jurusan Ilmu Komputer, Teknik Informatika, atau bidang terkait\n2. IPK minimal 3.25\n3. Semester 3-6 saat pendaftaran\n4. Mampu membuktikan proyek/karya coding yang pernah dibuat\n5. Fasih berbahasa Inggris\n6. Menulis esai teknologi (600-800 kata)",
                'benefits'          => "✅ Beasiswa senilai $2,500 USD/semester\n✅ Akses Google Developer Program\n✅ Mentoring oleh engineer Google\n✅ Undangan Google I/O Conference\n✅ Prioritas program magang Google",
                'registration_link' => 'https://buildyourfuture.withgoogle.com/scholarships',
                'status'            => 'published',
                'poster'            => 'https://picsum.photos/seed/sch2/800/500',
            ],
            [
                'title'             => 'Beasiswa LPDP Program Reguler S2/S3',
                'organizer'         => 'Lembaga Pengelola Dana Pendidikan (LPDP)',
                'location'          => 'Dalam & Luar Negeri',
                'description'       => "LPDP (Lembaga Pengelola Dana Pendidikan) adalah beasiswa paling bergengsi di Indonesia yang dikelola oleh Kementerian Keuangan. Program Reguler ini terbuka untuk WNI yang ingin melanjutkan studi ke jenjang S2 atau S3 di universitas terbaik dalam dan luar negeri.\n\nDengan total dana kelolaan triliunan rupiah, LPDP berkomitmen untuk mencetak pemimpin-pemimpin Indonesia masa depan yang mampu bersaing di kancah global.",
                'requirements'      => "1. WNI dengan KTP aktif\n2. Lulus S1 dengan IPK min 3.00 (untuk S2) atau S2 dengan IPK min 3.25 (untuk S3)\n3. Skor IELTS 6.5 atau TOEFL iBT 80 untuk luar negeri\n4. Skor TOEFL ITP 500 untuk dalam negeri\n5. Usia maksimal 35 tahun (S2) / 40 tahun (S3)\n6. LoA Unconditional dari universitas tujuan (untuk DN tidak wajib)\n7. Esai komitmen kembali ke Indonesia",
                'benefits'          => "✅ Dana pendidikan penuh tanpa batas\n✅ Dana hidup bulanan\n✅ Dana transportasi\n✅ Dana kedatangan\n✅ Dana keadaan darurat\n✅ Asuransi kesehatan premium\n✅ Dana penelitian dan disertasi",
                'registration_link' => 'https://lpdp.kemenkeu.go.id',
                'status'            => 'published',
                'poster'            => 'https://picsum.photos/seed/sch3/800/500',
            ],
            [
                'title'             => 'Erasmus+ Student Exchange Program 2026',
                'organizer'         => 'European Commission / Erasmus+',
                'location'          => 'Eropa (27 Negara Anggota EU)',
                'description'       => "Program pertukaran pelajar Erasmus+ memberikan kesempatan luar biasa bagi mahasiswa Indonesia untuk kuliah di lebih dari 27 negara Eropa selama 1-2 semester. Ini adalah salah satu program pertukaran terbesar dan paling bergengsi di dunia.\n\nSelain pengalaman akademik kelas dunia, kamu akan mendapatkan pengalaman multikultural yang tidak ternilai, membangun jaringan internasional, dan memperkuat portfolio global kamu.",
                'requirements'      => "1. Mahasiswa aktif semester 4 ke atas\n2. IPK minimal 3.00\n3. Kemampuan bahasa Inggris (IELTS 6.0 atau setara)\n4. Kemampuan bahasa negara tujuan adalah nilai plus\n5. Surat rekomendasi dari dosen koordinator internasional\n6. Proposal rencana studi di universitas tujuan\n7. CV dalam format Europass",
                'benefits'          => "✅ Biaya kuliah di universitas Eropa gratis\n✅ Stipend bulanan €250-€700 (tergantung negara tujuan)\n✅ Tiket perjalanan PP\n✅ Akomodasi di dormitory kampus\n✅ Kartu ISIC (International Student Identity Card)\n✅ Transfer kredit ke universitas asal",
                'registration_link' => 'https://erasmus-plus.ec.europa.eu',
                'status'            => 'published',
                'poster'            => 'https://picsum.photos/seed/sch4/800/500',
            ],
            [
                'title'             => 'Beasiswa Yayasan Sampoerna Foundation 2026',
                'organizer'         => 'Sampoerna Foundation',
                'location'          => 'Seluruh Indonesia',
                'description'       => "Sampoerna Foundation telah mendukung ribuan mahasiswa berprestasi Indonesia selama lebih dari 20 tahun. Program beasiswa ini fokus pada pengembangan pemimpin masa depan Indonesia yang tidak hanya unggul secara akademik, tetapi juga memiliki karakter dan jiwa kepemimpinan yang kuat.\n\nPenerima beasiswa akan bergabung dalam komunitas alumni Sampoerna yang tersebar di ratusan perusahaan dan institusi terkemuka di Indonesia.",
                'requirements'      => "1. Warga negara Indonesia\n2. Mahasiswa S1 semester 1-4 dari keluarga kurang mampu\n3. IPK minimal 3.00 atau setara nilai SMA 85/100\n4. Penghasilan orang tua maksimal Rp 3.000.000/bulan\n5. Aktif dalam kegiatan organisasi/sosial\n6. Bukan penerima beasiswa lain",
                'benefits'          => "✅ Tunjangan pendidikan Rp 12.000.000/tahun\n✅ Tunjangan hidup Rp 500.000/bulan\n✅ Program pengembangan kepemimpinan\n✅ Career coaching & job placement\n✅ Akses jaringan alumni eksklusif",
                'registration_link' => 'https://www.sampoernafoundation.org',
                'status'            => 'published',
                'poster'            => 'https://picsum.photos/seed/sch5/800/500',
            ],
            [
                'title'             => 'Beasiswa Djarum Plus 2026',
                'organizer'         => 'Bakti Pendidikan Djarum Foundation',
                'location'          => 'Seluruh Indonesia',
                'description'       => "Beasiswa Djarum Plus merupakan program beasiswa prestasi yang tidak hanya memberikan bantuan finansial, tetapi juga program pembentukan karakter dan soft skills yang komprehensif. Program ini dirancang untuk melahirkan Best People yang siap menjadi pemimpin dan profesional unggul.\n\nSelama menjadi penerima beasiswa, mahasiswa akan mengikuti Character Building Program (CBP) yang mencakup training nasionalisme, kepemimpinan, kewirausahaan, dan pengabdian masyarakat.",
                'requirements'      => "1. Mahasiswa aktif S1 semester 4 (min) - 6 (maks)\n2. IPK minimal 3.20 (skala 4.00)\n3. Bukan mahasiswa penerima beasiswa lain\n4. Aktif berorganisasi (minimal 1 organisasi intra/ekstra kampus)\n5. Usia maksimal 23 tahun\n6. Mampu mengikuti semua program Character Building",
                'benefits'          => "✅ Biaya hidup Rp 750.000/bulan\n✅ Character Building Program intensif\n✅ Leadership & soft skills training\n✅ Networking event nasional\n✅ Alumni community seumur hidup",
                'registration_link' => 'https://www.djarumbeasiswa.com',
                'status'            => 'published',
                'poster'            => 'https://picsum.photos/seed/sch6/800/500',
            ],
            [
                'title'             => 'Beasiswa Riset Inovasi Nasional 2026',
                'organizer'         => 'Badan Riset dan Inovasi Nasional (BRIN)',
                'location'          => 'Bandung, Jakarta, Serpong',
                'description'       => "Program Beasiswa Riset Inovasi Nasional dari BRIN ditujukan untuk mendukung mahasiswa S2/S3 yang sedang menjalani penelitian inovatif di bidang sains, teknologi, engineering, dan matematika (STEM). Penerima beasiswa akan mendapatkan akses ke laboratorium dan fasilitas penelitian kelas dunia milik BRIN.\n\nIni adalah kesempatan langka untuk berkolaborasi langsung dengan peneliti senior dan ilmuwan terkemuka Indonesia dalam proyek-proyek riset strategis nasional.",
                'requirements'      => "1. Mahasiswa aktif S2/S3 di bidang STEM\n2. Memiliki proposal penelitian yang relevan dengan prioritas riset BRIN\n3. IPK minimal 3.25\n4. Sudah memiliki pembimbing/promotor yang bersedia bekerja sama\n5. Publikasi ilmiah (jurnal/konferensi) akan menjadi nilai plus",
                'benefits'          => "✅ Dana penelitian Rp 30.000.000/tahun\n✅ Akses laboratorium BRIN\n✅ Bimbingan peneliti senior\n✅ Kesempatan publikasi internasional bersama BRIN\n✅ Co-authorship dalam paper ilmiah",
                'registration_link' => 'https://brin.go.id/beasiswa',
                'status'            => 'published',
                'poster'            => 'https://picsum.photos/seed/sch7/800/500',
            ],
            [
                'title'             => 'Beasiswa Bank Indonesia 2026',
                'organizer'         => 'Bank Indonesia (BI)',
                'location'          => 'Seluruh Indonesia',
                'description'       => "Program beasiswa Bank Indonesia dirancang untuk menghasilkan generasi muda yang melek ekonomi dan memiliki kompetensi di bidang keuangan, perbankan, dan kebijakan moneter. Program ini merupakan bagian dari komitmen BI dalam membangun ekosistem ekonomi Indonesia yang lebih kuat.\n\nPenerima beasiswa tidak hanya mendapatkan dukungan finansial, tetapi juga akses ke program magang di kantor Bank Indonesia di seluruh Indonesia.",
                'requirements'      => "1. Mahasiswa S1/S2 bidang Ekonomi, Manajemen, Akuntansi, atau Statistika\n2. IPK minimal 3.00\n3. Semester 3-7 untuk S1, semester 1-3 untuk S2\n4. Aktif berorganisasi di kampus\n5. Tidak sedang bekerja full-time\n6. Esai tentang perekonomian Indonesia",
                'benefits'          => "✅ Tunjangan pendidikan Rp 10.000.000/tahun\n✅ Tunjangan hidup Rp 700.000/bulan\n✅ Pelatihan dan seminar ekonomi eksklusif\n✅ Program magang di kantor BI\n✅ Akses perpustakaan digital BI",
                'registration_link' => 'https://www.bi.go.id/beasiswabi',
                'status'            => 'published',
                'poster'            => 'https://picsum.photos/seed/sch8/800/500',
            ],
            [
                'title'             => 'Tanoto Foundation Scholarship Program',
                'organizer'         => 'Tanoto Foundation',
                'location'          => 'Seluruh Indonesia',
                'description'       => "Tanoto Foundation, didirikan oleh pengusaha sukses Sukanto Tanoto, memberikan beasiswa komprehensif bagi mahasiswa berprestasi dari keluarga kurang mampu. Program ini berfokus pada pengembangan pemimpin yang memiliki integritas, karakter kuat, dan kepedulian sosial tinggi.\n\nDengan track record lebih dari 40 tahun, Tanoto Foundation telah membantu lebih dari 15.000 penerima beasiswa mencapai impian mereka.",
                'requirements'      => "1. WNI dari keluarga ekonomi menengah ke bawah\n2. Mahasiswa S1 aktif di 7 universitas mitra Tanoto\n3. IPK minimal 3.00\n4. Tidak merokok\n5. Bersedia mengikuti semua program pengembangan Tanoto\n6. Bukti penghasilan orang tua",
                'benefits'          => "✅ Tunjangan hidup Rp 500.000/bulan\n✅ Leadership development program\n✅ Community service requirements\n✅ Mentoring dari profesional senior\n✅ Jaringan alumni Tanoto global",
                'registration_link' => 'https://www.tanotofoundation.org/beasiswa',
                'status'            => 'published',
                'poster'            => 'https://picsum.photos/seed/sch9/800/500',
            ],
            [
                'title'             => 'Beasiswa AMDB (Anak Muda Digital Bangsa)',
                'organizer'         => 'Kementerian Komunikasi dan Informatika',
                'location'          => 'Seluruh Indonesia (Online)',
                'description'       => "Program Beasiswa Anak Muda Digital Bangsa (AMDB) adalah inisiatif Kemenkominfo untuk mempercepat transformasi digital Indonesia dengan mencetak talenta digital muda. Program ini memberikan beasiswa penuh untuk kursus dan bootcamp digital terpilih.\n\nPenerima beasiswa akan mendapatkan akses ke lebih dari 50 kursus digital premium dan sertifikasi internasional yang diakui oleh ratusan perusahaan teknologi di Indonesia.",
                'requirements'      => "1. WNI berusia 18-30 tahun\n2. Minimal lulusan SMA/SMK\n3. Memiliki minat di bidang digital (coding, desain, data, dll)\n4. Memiliki koneksi internet yang stabil\n5. Komitmen menyelesaikan program dalam 6 bulan",
                'benefits'          => "✅ Akses ratusan kursus digital premium GRATIS\n✅ Sertifikasi internasional (Google, AWS, dll)\n✅ Mentoring dari praktisi industri\n✅ Peluang magang di perusahaan teknologi\n✅ Job fair khusus alumni program",
                'registration_link' => 'https://digitalent.kominfo.go.id',
                'status'            => 'published',
                'poster'            => 'https://picsum.photos/seed/sch10/800/500',
            ],
        ];

        foreach ($scholarships as $index => $data) {
            Scholarship::create(array_merge($data, [
                'slug'       => Str::slug($data['title']) . '-' . rand(100, 999),
                'start_date' => Carbon::now()->addDays(rand(1, 14)),
                'end_date'   => Carbon::now()->addDays(rand(30, 120)),
                'created_by' => $admin->id,
            ]));
        }

        // =====================================================
        // 2. DUMMY BOOTCAMP / WORKSHOP / WEBINAR (12 data)
        // =====================================================
        $bootcamps = [
            [
                'title'            => 'Fullstack Web Development Bootcamp (Laravel + React)',
                'organizer'        => 'Sakara Academy',
                'location'         => 'Online via Zoom',
                'type'             => 'bootcamp',
                'level'            => 'Intermediate',
                'max_participants' => 50,
                'description'      => "Kuasai pengembangan aplikasi web modern dari nol hingga deploy! Dalam bootcamp 4 minggu intensif ini, kamu akan belajar membangun REST API dengan Laravel 11 yang powerful dan UI yang responsif dengan React 18.\n\nProgram ini dirancang oleh praktisi industri yang berpengalaman lebih dari 8 tahun di perusahaan teknologi terkemuka. Setiap sesi dilengkapi dengan proyek nyata yang bisa langsung masuk portfolio kamu.",
                'requirements'    => "- Memahami dasar HTML, CSS, dan JavaScript (wajib)\n- Familiar dengan konsep dasar PHP akan menjadi nilai plus\n- Laptop RAM minimal 8GB\n- Koneksi internet stabil minimal 10 Mbps\n- Kemauan belajar dan komitmen waktu 4-6 jam per hari",
                'curriculum'      => "Minggu 1: PHP Modern & Laravel Fundamentals\n  - PSR Standards & Composer\n  - Laravel MVC Architecture\n  - Eloquent ORM & Database Design\n  - Authentication & Authorization\n\nMinggu 2: Laravel Advanced & REST API\n  - API Resource & Transformation\n  - Laravel Sanctum\n  - Testing dengan PHPUnit\n  - Queue & Job System\n\nMinggu 3: React 18 & State Management\n  - React Hooks Deep Dive\n  - Redux Toolkit\n  - React Query untuk data fetching\n  - Tailwind CSS dengan React\n\nMinggu 4: Full Integration & Deployment\n  - Menghubungkan Laravel API dengan React\n  - Deploy ke VPS dengan Nginx\n  - CI/CD dasar dengan GitHub Actions\n  - Final Project Presentation",
                'registration_link' => 'https://sakaraacademy.com/fullstack',
                'status'           => 'published',
                'is_paid'          => true,
                'price'            => 1500000,
                'poster'           => 'https://picsum.photos/seed/boot1/800/500',
            ],
            [
                'title'            => 'Workshop Intensif UI/UX Design dengan Figma',
                'organizer'        => 'DesignSpace Indonesia',
                'location'         => 'Jakarta Selatan (Offline)',
                'type'             => 'workshop',
                'level'            => 'Beginner',
                'max_participants' => 30,
                'description'      => "Workshop 2 hari intensif khusus untuk kamu yang ingin terjun ke dunia UI/UX Design. Dipandu langsung oleh Lead Designer dari startup unicorn Indonesia, workshop ini akan memandu kamu dari zero hingga bisa membuat prototype interaktif yang profesional.\n\nKamu akan langsung praktik menggunakan Figma — tools desain nomor 1 yang digunakan oleh designer-designer di Google, Airbnb, dan hampir semua startup teknologi dunia.",
                'requirements'    => "- Sudah menginstall Figma (versi gratis sudah cukup)\n- Bawa laptop sendiri (Windows/Mac)\n- Tidak ada persyaratan pengalaman — cocok untuk pemula!\n- Siapkan ide aplikasi yang ingin kamu desain",
                'curriculum'      => "Hari 1: Fundamental UX Design\n  - Design Thinking Framework\n  - User Research & Persona\n  - User Journey Mapping\n  - Information Architecture\n  - Low-fidelity Wireframing di Figma\n\nHari 2: UI Design & Prototyping\n  - Prinsip Visual Design (Color, Typography, Spacing)\n  - Component Library & Design System\n  - High-fidelity UI Design\n  - Interactive Prototyping\n  - Usability Testing Sederhana\n  - Portfolio Review Session",
                'registration_link' => 'https://designspace.id/workshop-figma',
                'status'           => 'published',
                'is_paid'          => true,
                'price'            => 750000,
                'poster'           => 'https://picsum.photos/seed/boot2/800/500',
            ],
            [
                'title'            => 'Free Webinar: Intro to Data Science & AI',
                'organizer'        => 'DataCamp Indonesia',
                'location'         => 'Online (YouTube Live)',
                'type'             => 'webinar',
                'level'            => 'Beginner',
                'max_participants' => 500,
                'description'      => "Webinar GRATIS untuk kamu yang penasaran dengan Data Science dan Artificial Intelligence! Di era digital ini, kemampuan mengolah dan menganalisis data adalah skill paling dicari oleh perusahaan-perusahaan Fortune 500.\n\nSesi 3 jam ini akan membuka pikiranmu tentang apa itu Data Science, bagaimana AI bekerja di balik layar, dan langkah-langkah konkret untuk memulai karir di bidang ini — bahkan tanpa background coding sama sekali.",
                'requirements'    => "- Tidak ada persyaratan khusus!\n- Siapkan aplikasi YouTube di HP/laptop\n- Boleh bertanya langsung via live chat\n- Disarankan memiliki akun Google Colab (gratis)",
                'curriculum'      => "Sesi 1: What is Data Science & AI? (60 menit)\n  - Perbedaan Data Science, ML, dan AI\n  - Real case study: Netflix, Gojek, Tokopedia menggunakan AI\n  - Roadmap karir Data Scientist\n\nSesi 2: Python untuk Data Science (60 menit)\n  - Kenapa Python?\n  - Demo langsung: Pandas & NumPy\n  - Visualisasi data dengan Matplotlib\n\nSesi 3: Live Demo & Q&A (60 menit)\n  - Build model Machine Learning sederhana\n  - Tanya jawab dengan narasumber\n  - Info program lanjutan",
                'registration_link' => 'https://youtube.com/live/datacamp-id',
                'status'           => 'published',
                'is_paid'          => false,
                'price'            => null,
                'poster'           => 'https://picsum.photos/seed/boot3/800/500',
            ],
            [
                'title'            => 'Digital Marketing Masterclass: SEO, Ads & Social Media',
                'organizer'        => 'MarketeersHub Academy',
                'location'         => 'Online via Zoom',
                'type'             => 'bootcamp',
                'level'            => 'Beginner',
                'max_participants' => 100,
                'description'      => "Di era digital ini, setiap bisnis butuh strategi digital marketing yang tepat. Bootcamp 3 minggu ini mengajarkan kamu cara menguasai SEO, Google Ads, Meta Ads, dan Social Media Marketing secara komprehensif.\n\nKamu akan belajar langsung dari praktisi digital marketing berpengalaman yang telah membantu ratusan UMKM dan startup meningkatkan revenue mereka hingga 10x melalui strategi digital yang tepat sasaran.",
                'requirements'    => "- Memiliki akun Google dan Meta/Facebook\n- Laptop dengan koneksi internet\n- Direkomendasikan memiliki bisnis/produk yang ingin dipasarkan\n- Tidak diperlukan pengalaman marketing sebelumnya",
                'curriculum'      => "Minggu 1: SEO & Content Marketing\n  - SEO On-page dan Off-page\n  - Keyword Research dengan SEMrush\n  - Content Strategy & Blog Writing\n  - Google Search Console\n\nMinggu 2: Paid Advertising\n  - Google Ads (Search, Display, Shopping)\n  - Meta Ads (Facebook & Instagram)\n  - TikTok Ads\n  - Membaca dan mengoptimalkan analytics\n\nMinggu 3: Social Media & Email Marketing\n  - Social Media Strategy\n  - Content Creation & Scheduling\n  - Email Marketing dengan Mailchimp\n  - Final Project: Campaign Plan Presentation",
                'registration_link' => 'https://marketeershub.id/bootcamp',
                'status'           => 'published',
                'is_paid'          => true,
                'price'            => 1200000,
                'poster'           => 'https://picsum.photos/seed/boot4/800/500',
            ],
            [
                'title'            => 'Workshop Koding Python untuk Pelajar SMA & Mahasiswa',
                'organizer'        => 'Code for Indonesia',
                'location'         => 'Bandung (Offline)',
                'type'             => 'workshop',
                'level'            => 'Beginner',
                'max_participants' => 40,
                'description'      => "Workshop seru 1 hari untuk pelajar SMA dan mahasiswa semester awal yang ingin belajar coding Python dari nol. Tidak perlu pengalaman programming sama sekali! Dipandu oleh relawan pengajar dari komunitas developer terbesar di Bandung.\n\nSetiap peserta akan pulang dengan membawa mini proyek yang sudah jadi dan bisa langsung di-share ke teman-teman. Selain itu, kamu juga akan mendapat sertifikat dan akses ke learning resources eksklusif.",
                'requirements'    => "- Pelajar SMA atau mahasiswa semester 1-2\n- Bawa laptop (jika tidak punya, tersedia 10 unit komputer)\n- Sudah menginstall Python 3.x dari python.org\n- Antusias belajar hal baru!",
                'curriculum'      => "Pagi (09.00 - 12.00):\n  - Pengenalan Programming & Python\n  - Variable, Data Types, dan Operators\n  - Conditional Statements (if/else)\n  - Loops (for, while)\n  - Praktik: Mini Quiz Game\n\nSiang (13.00 - 17.00):\n  - Functions & Modules\n  - File Reading & Writing\n  - Pengenalan Libraries (NumPy)\n  - Mini Project: Kalkulator BMI\n  - Presentasi & Review\n  - Sertifikasi",
                'registration_link' => 'https://codeforindonesia.id/workshop-python',
                'status'           => 'published',
                'is_paid'          => false,
                'price'            => null,
                'poster'           => 'https://picsum.photos/seed/boot5/800/500',
            ],
            [
                'title'            => 'Public Speaking & Pitching Masterclass',
                'organizer'        => 'BicaraPede Institute',
                'location'         => 'Bandung & Online',
                'type'             => 'workshop',
                'level'            => 'All Level',
                'max_participants' => 25,
                'description'      => "Takut berbicara di depan umum? Tidak tahu cara mempresentasikan ide dengan meyakinkan? Workshop 2 hari intensif ini akan mengubahmu menjadi komunikator yang percaya diri dan presenter yang memukau.\n\nDipandu oleh trainer bersertifikat internasional yang telah melatih ribuan profesional dari berbagai perusahaan BUMN dan swasta, workshop ini menggabungkan teori komunikasi dengan praktik intensif yang akan membuat kemampuan berbicara kamu melejit drastis.",
                'requirements'    => "- Membawa baju formal kasual\n- Siapkan topik yang ingin dipresentasikan (3-5 menit)\n- Tidak ada persyaratan pengalaman\n- Terbuka untuk semua kalangan (mahasiswa, profesional, pebisnis)",
                'curriculum'      => "Hari 1: Fondasi Komunikasi Efektif\n  - The Psychology of Speaking\n  - Body Language & Vocal Power\n  - Mengatasi Demam Panggung\n  - Storytelling Techniques\n  - Praktik: Impromptu Speaking\n\nHari 2: Advanced Pitching Skills\n  - Struktur Pitch yang Memenangkan\n  - Visual Aid & Slide Design\n  - Handling Q&A dengan Percaya Diri\n  - Mock Pitching Session\n  - Individual Feedback & Coaching",
                'registration_link' => 'https://bicarapede.id/masterclass',
                'status'           => 'published',
                'is_paid'          => true,
                'price'            => 600000,
                'poster'           => 'https://picsum.photos/seed/boot6/800/500',
            ],
            [
                'title'            => 'Mobile App Development dengan Flutter (Gratis)',
                'organizer'        => 'GDG (Google Developer Group) Surabaya',
                'location'         => 'Online (Google Meet)',
                'type'             => 'webinar',
                'level'            => 'Intermediate',
                'max_participants' => 200,
                'description'      => "Google Developer Group Surabaya menghadirkan webinar gratis tentang pengembangan aplikasi mobile cross-platform menggunakan Flutter dan Dart. Flutter adalah framework buatan Google yang memungkinkan kamu membuat aplikasi Android, iOS, Web, dan Desktop sekaligus dengan satu codebase.\n\nIni adalah kesempatan emas untuk belajar langsung dari Flutter Developer bersertifikat Google tanpa biaya sepeser pun!",
                'requirements'    => "- Sudah familiar dengan bahasa pemrograman apapun\n- Terinstall Flutter SDK (link instalasi akan diberikan setelah daftar)\n- Bawa laptop dengan RAM minimal 8GB\n- Akun Google untuk akses Google Meet",
                'curriculum'      => "Sesi 1: Flutter & Dart Basics (2 jam)\n  - Mengapa Flutter?\n  - Dart Programming Language\n  - Widget Tree & Hot Reload\n  - Basic Widgets\n\nSesi 2: Building Real App (2 jam)\n  - Layout & Responsive Design\n  - State Management dengan Provider\n  - Navigasi & Routing\n  - HTTP Requests & JSON Parsing\n  - Demo: Todo App\n\nSesi 3: Q&A & Next Steps (1 jam)",
                'registration_link' => 'https://gdg.community.dev/surabaya',
                'status'           => 'published',
                'is_paid'          => false,
                'price'            => null,
                'poster'           => 'https://picsum.photos/seed/boot7/800/500',
            ],
            [
                'title'            => 'Kewirausahaan & Startup Bootcamp 2026',
                'organizer'        => 'Incubator Nusantara',
                'location'         => 'Jakarta Pusat (Offline)',
                'type'             => 'bootcamp',
                'level'            => 'All Level',
                'max_participants' => 60,
                'description'      => "Punya ide bisnis tapi tidak tahu harus mulai dari mana? Bootcamp Kewirausahaan 5 hari intensif ini akan memandu kamu dari ideasi hingga pitching kepada investor nyata!\n\nDipandu oleh founder-founder startup sukses Indonesia yang telah membangun bisnis bernilai miliaran rupiah, kamu akan mendapatkan framework, tools, dan mindset yang dibutuhkan untuk membangun startup yang sustainable.",
                'requirements'    => "- Memiliki ide bisnis (tidak harus final)\n- Berusia 18-35 tahun\n- Komitmen hadir seluruh sesi selama 5 hari\n- Laptop untuk workshop\n- Semangat entrepreneurship!",
                'curriculum'      => "Hari 1: Ideation & Problem Validation\n  - Design Thinking\n  - Problem-Solution Fit\n  - Customer Discovery Interviews\n\nHari 2: Business Model Canvas\n  - Value Proposition\n  - Revenue Streams\n  - Cost Structure\n\nHari 3: Product & Tech\n  - MVP (Minimum Viable Product)\n  - Agile & Lean Startup\n  - Tech Stack Selection\n\nHari 4: Marketing & Sales\n  - Go-to-Market Strategy\n  - Growth Hacking\n  - Building Sales Funnel\n\nHari 5: Pitching Day\n  - Investor Pitch Deck\n  - Financial Projection\n  - Live Pitching ke Panel Investor\n  - Graduation & Networking",
                'registration_link' => 'https://incubatornusantara.id/bootcamp',
                'status'           => 'published',
                'is_paid'          => true,
                'price'            => 2500000,
                'poster'           => 'https://picsum.photos/seed/boot8/800/500',
            ],
            [
                'title'            => 'Cybersecurity Fundamentals Workshop',
                'organizer'        => 'ID-CERT (Indonesia Computer Emergency Response Team)',
                'location'         => 'Online via Zoom',
                'type'             => 'workshop',
                'level'            => 'Beginner',
                'max_participants' => 75,
                'description'      => "Di era digital yang semakin rentan terhadap ancaman siber, kemampuan cybersecurity menjadi skill yang paling dibutuhkan dan paling langka di Indonesia. Workshop 1 hari ini memberikan fondasi kuat dalam pemahaman keamanan siber.\n\nKamu akan belajar dari pakar keamanan siber yang berpengalaman dalam menangani insiden siber di berbagai instansi pemerintah dan perusahaan besar Indonesia.",
                'requirements'    => "- Minimal pengetahuan dasar networking (IP Address, DNS)\n- Laptop dengan OS Windows, Mac, atau Linux\n- Sudah terinstall VirtualBox atau VMware (opsional tapi disarankan)\n- Rasa ingin tahu yang tinggi!",
                'curriculum'      => "Pagi (09.00 - 12.00):\n  - Landscape Ancaman Siber di Indonesia\n  - CIA Triad & Security Frameworks\n  - Common Attack Vectors\n  - Social Engineering & Phishing Demo\n\nSiang (13.00 - 17.00):\n  - Network Security Basics\n  - Password Security & Multi-Factor Authentication\n  - Practical: CTF Challenge Sederhana\n  - Incident Response Basics\n  - Sertifikasi & Resources Lanjutan",
                'registration_link' => 'https://idcert.or.id/workshop',
                'status'           => 'published',
                'is_paid'          => true,
                'price'            => 350000,
                'poster'           => 'https://picsum.photos/seed/boot9/800/500',
            ],
            [
                'title'            => 'Video Editing & Content Creator Masterclass',
                'organizer'        => 'CreatorHub Academy',
                'location'         => 'Online via Discord',
                'type'             => 'bootcamp',
                'level'            => 'Beginner',
                'max_participants' => 80,
                'description'      => "Di era konten digital, kemampuan membuat dan mengedit video adalah skill yang bisa langsung menghasilkan uang. Bootcamp 2 minggu ini akan mengajarkan kamu segala hal yang dibutuhkan untuk menjadi content creator profesional, mulai dari scripting, shooting, hingga editing yang cinematic.\n\nMentormu adalah YouTuber dengan 500K+ subscribers dan kreator konten yang sudah berkolaborasi dengan brand-brand ternama Indonesia.",
                'requirements'    => "- HP dengan kamera minimal 12MP atau kamera mirrorless\n- Laptop untuk editing (RAM min 8GB)\n- Terinstall CapCut atau Premiere Pro\n- Akun YouTube/TikTok/Instagram\n- Tidak perlu pengalaman sebelumnya!",
                'curriculum'      => "Minggu 1: Foundation Content Creation\n  - Content Strategy & Niche\n  - Storytelling untuk Video\n  - Shooting Techniques\n  - Lighting Natural & Artificial\n  - Audio Recording Tips\n\nMinggu 2: Post Production & Growth\n  - Color Grading\n  - Motion Graphics Dasar\n  - Thumbnail Design\n  - YouTube SEO\n  - Monetisasi & Brand Deal\n  - Final Project: Publish 1 Video",
                'registration_link' => 'https://creatorhub.id/masterclass',
                'status'           => 'published',
                'is_paid'          => true,
                'price'            => 899000,
                'poster'           => 'https://picsum.photos/seed/boot10/800/500',
            ],
            [
                'title'            => 'Free Webinar: Cara Lolos Beasiswa LPDP & BPI',
                'organizer'        => 'Komunitas Awardee LPDP',
                'location'         => 'Online (Zoom)',
                'type'             => 'webinar',
                'level'            => 'All Level',
                'max_participants' => 1000,
                'description'      => "Webinar GRATIS dari alumni penerima LPDP & BPI yang siap berbagi pengalaman dan tips rahasia lolos seleksi beasiswa bergengsi. Banyak yang mengira lolos LPDP itu mustahil — padahal ada strategi jelas yang bisa dipelajari.\n\nDalam 2 jam webinar ini, kamu akan mendapatkan panduan step-by-step dari para awardee yang telah berhasil menembus seleksi ketat beasiswa LPDP dan BPI dari berbagai latar belakang jurusan.",
                'requirements'    => "- Tidak ada persyaratan khusus!\n- Siapkan pertanyaan yang ingin ditanyakan\n- Bawa semangat dan mimpi kamu\n- Link Zoom akan dikirim setelah registrasi",
                'curriculum'      => "Sesi 1: Overview Beasiswa LPDP & BPI (30 menit)\n  - Perbedaan LPDP vs BPI\n  - Timeline dan jadwal pendaftaran\n\nSesi 2: Tips Lolos Dokumen (45 menit)\n  - Essay yang berhasil (contoh nyata)\n  - Cara menulis motivation letter\n  - Persiapan rekomendasi dosen\n\nSesi 3: Tips Lolos Wawancara (30 menit)\n  - Pertanyaan umum dan cara menjawab\n  - Simulasi wawancara\n\nSesi 4: Q&A Open (15 menit)",
                'registration_link' => 'https://bit.ly/webinar-lpdp-bpi',
                'status'           => 'published',
                'is_paid'          => false,
                'price'            => null,
                'poster'           => 'https://picsum.photos/seed/boot11/800/500',
            ],
            [
                'title'            => 'Bootcamp Cloud Computing & DevOps (AWS)',
                'organizer'        => 'CloudAcademy ID',
                'location'         => 'Online via Zoom',
                'type'             => 'bootcamp',
                'level'            => 'Intermediate',
                'max_participants' => 40,
                'description'      => "Cloud Computing adalah fondasi dari hampir semua teknologi modern. Bootcamp intensif 4 minggu ini akan mempersiapkan kamu untuk mendapatkan sertifikasi AWS Cloud Practitioner atau Associate, salah satu sertifikasi paling dicari di industri IT saat ini.\n\nKamu akan belajar membangun infrastruktur cloud yang scalable, mengimplementasikan CI/CD pipeline, dan mengelola aplikasi di cloud — skill yang bisa menaikkan gaji kamu 50-100%.",
                'requirements'    => "- Pemahaman dasar networking dan Linux\n- Pengalaman minimal dengan salah satu bahasa pemrograman\n- Akun AWS (free tier tersedia)\n- Laptop RAM minimal 8GB\n- Komitmen belajar 3-4 jam per hari",
                'curriculum'      => "Minggu 1: AWS Fundamentals\n  - Cloud Computing Concepts\n  - AWS Core Services (EC2, S3, RDS, VPC)\n  - IAM & Security\n  - AWS CLI\n\nMinggu 2: Architecture & Scalability\n  - Auto Scaling & Load Balancing\n  - Serverless dengan Lambda\n  - Container dengan ECS\n  - Database Services (DynamoDB, ElastiCache)\n\nMinggu 3: DevOps & CI/CD\n  - Git Advanced\n  - Docker & Kubernetes Dasar\n  - CI/CD dengan CodePipeline\n  - Infrastructure as Code (CloudFormation)\n\nMinggu 4: Monitoring & Final Project\n  - CloudWatch & Logging\n  - Cost Optimization\n  - Final Project: Deploy Full-Stack App ke AWS\n  - Mock Exam AWS Certification",
                'registration_link' => 'https://cloudacademy.id/aws-bootcamp',
                'status'           => 'published',
                'is_paid'          => true,
                'price'            => 3500000,
                'poster'           => 'https://picsum.photos/seed/boot12/800/500',
            ],
        ];

        foreach ($bootcamps as $index => $data) {
            Bootcamp::create(array_merge($data, [
                'slug'       => Str::slug($data['title']) . '-' . rand(100, 999),
                'start_date' => Carbon::now()->addDays(rand(3, 20)),
                'end_date'   => Carbon::now()->addDays(rand(21, 60)),
                'created_by' => $admin->id,
            ]));
        }

        // =====================================================
        // 3. DUMMY BERITA (6 artikel)
        // =====================================================
        $news = [
            [
                'title'    => '5 Tips Ampuh Lolos Seleksi Beasiswa LPDP 2026 Tanpa Perlu Koneksi',
                'category' => 'Tips & Trik',
                'content'  => "Setiap tahun, ratusan ribu calon pelamar bersaing untuk mendapatkan beasiswa LPDP. Banyak yang menduga bahwa lolos LPDP hanya untuk mereka yang memiliki koneksi atau berasal dari universitas tertentu. Namun kenyataannya, dengan persiapan yang sistematis dan matang, siapapun bisa lolos.\n\nBerikut adalah 5 tips yang terbukti efektif berdasarkan pengalaman ratusan awardee LPDP:\n\n1. Mulai Persiapan 6 Bulan Sebelum Pendaftaran\nJangan tunggu sampai pendaftaran dibuka. Persiapkan semua dokumen, skor bahasa Inggris, dan LoA jauh-jauh hari. Banyak pelamar gagal hanya karena kekurangan waktu persiapan.\n\n2. Tulis Essay yang Autentik dan Personal\nPanitia LPDP membaca ribuan essay. Yang membuat essay kamu berbeda adalah keautentikan cerita pribadimu. Hindari template generik dan ceritakan pengalaman nyata yang membentuk visimu.\n\n3. Riset Mendalam tentang Universitas Tujuan\nTunjukkan bahwa kamu sudah benar-benar meriset kampus dan program tujuan. Sebutkan professor spesifik yang ingin kamu ajak riset, dan hubungkan dengan rencana penelitianmu.\n\n4. Latihan Wawancara dengan Simulasi Nyata\nBuat grup belajar dengan teman-teman sesama calon pendaftar. Lakukan simulasi wawancara setidaknya 10 kali sebelum hari H.\n\n5. Tunjukkan Kontribusi yang Sudah Nyata\nLPDP ingin mendanai orang yang sudah berkontribusi, bukan yang baru ingin berkontribusi. Dokumentasikan semua kegiatan sosial, penelitian, atau volunteer yang pernah kamu lakukan.",
                'poster'   => 'https://picsum.photos/seed/news1/800/500',
            ],
            [
                'title'    => 'Skill Coding Semakin Wajib di Era AI — Ini Alasannya',
                'category' => 'Tech & Karir',
                'content'  => "Banyak yang salah paham: kehadiran AI justru semakin meningkatkan permintaan untuk programmer, bukan menguranginya. Mengapa? Karena AI membutuhkan programmer yang bisa memanfaatkannya secara efektif.\n\nData dari LinkedIn menunjukkan bahwa job posting yang mensyaratkan kemampuan coding meningkat 40% dalam 2 tahun terakhir. Sementara itu, programmer yang bisa menggunakan AI tools seperti GitHub Copilot, ChatGPT, dan Claude rata-rata 3-5x lebih produktif dibanding yang tidak.\n\nApa artinya bagi mahasiswa? Coding bukan lagi pilihan — ia adalah literasi dasar abad 21, seperti membaca dan menulis. Yang berbeda adalah caranya: kamu tidak perlu menghafal syntax, kamu perlu memahami logika dan konsep pemrograman.\n\nBahasa pemrograman yang paling dicari di 2026:\n1. Python (AI/ML, Data Science)\n2. JavaScript/TypeScript (Web Full-Stack)\n3. Go (Backend skala besar)\n4. SQL (Data Analysis)\n5. Rust (System Programming)\n\nKabar baiknya? Semua ini bisa dipelajari secara gratis. Yang terpenting adalah konsistensi dan project nyata sebagai portfolio.",
                'poster'   => 'https://picsum.photos/seed/news2/800/500',
            ],
            [
                'title'    => 'Bootcamp vs Kuliah vs Self-Taught: Mana yang Lebih Efektif untuk Karir IT?',
                'category' => 'Opini',
                'content'  => "Pertanyaan ini sering muncul di kalangan generasi Z yang ingin terjun ke industri teknologi. Tidak ada jawaban yang satu ukuran untuk semua — pilihan terbaik tergantung pada situasi, tujuan, dan karakter belajarmu.\n\nKuliah Formal (4 tahun)\nKelebihan: Gelar yang diakui, fondasi teori yang kuat, jaringan alumni, akses ke riset. Kekurangan: Mahal, butuh waktu lama, kurikulum seringkali tertinggal dari industri.\n\nBootcamp (2-6 bulan)\nKelebihan: Langsung praktis, update dengan kebutuhan industri, networking yang focused, cepat bisa bekerja. Kekurangan: Mahal jika tidak ada beasiswa, fondasi teori lebih tipis, kualitas sangat bervariasi.\n\nSelf-Taught (Belajar Mandiri)\nKelebihan: Gratis atau sangat murah, fleksibel, bisa sangat mendalam di bidang tertentu. Kekurangan: Butuh disiplin tinggi, mudah salah arah, portfolio butuh usaha ekstra untuk dibangun.\n\nRekomendasi Terbaik: Kombinasi!\nKuliah sambil aktif ikut bootcamp dan terus self-learning adalah kombinasi paling powerful. Data dari Hired.com menunjukkan bahwa fresh graduate yang juga memiliki sertifikasi bootcamp mendapatkan gaji awal 25% lebih tinggi dibanding yang hanya mengandalkan ijazah.",
                'poster'   => 'https://picsum.photos/seed/news3/800/500',
            ],
            [
                'title'    => 'Daftar Beasiswa S2 Luar Negeri yang Masih Buka Tahun 2026',
                'category' => 'Info Beasiswa',
                'content'  => "Mimpi kuliah S2 di luar negeri? Berikut adalah daftar beasiswa bergengsi yang masih membuka pendaftaran di tahun 2026:\n\n1. LPDP (Lembaga Pengelola Dana Pendidikan)\nNegara tujuan: Seluruh dunia | Deadline: Maret & Agustus | Beasiswa penuh\n\n2. Chevening Scholarship (Pemerintah UK)\nNegara tujuan: United Kingdom | Deadline: November | Beasiswa penuh termasuk tiket PP\n\n3. DAAD Scholarship (Pemerintah Jerman)\nNegara tujuan: Jerman | Deadline: Bervariasi per program | Beasiswa penuh + biaya hidup\n\n4. Fulbright (Pemerintah Amerika)\nNegara tujuan: USA | Deadline: Februari | Beasiswa penuh\n\n5. AAS (Australia Awards Scholarship)\nNegara tujuan: Australia | Deadline: April | Beasiswa penuh termasuk tiket PP\n\n6. Korea Government Scholarship (GKS)\nNegara tujuan: Korea Selatan | Deadline: Februari | Beasiswa penuh\n\n7. Erasmus+ Master Scholarship\nNegara tujuan: Eropa (27 negara) | Deadline: Bervariasi | €1,000/bulan\n\nTips: Mulai persiapkan dokumen dari sekarang, terutama skor bahasa asing dan recommendation letter dari dosen.",
                'poster'   => 'https://picsum.photos/seed/news4/800/500',
            ],
            [
                'title'    => 'Kenapa IPK Bukan Satu-Satunya Syarat Lolos Beasiswa',
                'category' => 'Tips & Trik',
                'content'  => "Sering kita mendengar mitos bahwa beasiswa hanya untuk mereka yang ber-IPK tinggi. Faktanya, banyak program beasiswa bergengsi yang lebih mementingkan potensi, karakter, dan kontribusi nyata dibanding nilai akademik semata.\n\nBerikut adalah faktor-faktor yang sebenarnya dinilai dalam seleksi beasiswa:\n\n1. Kepemimpinan dan Kontribusi Sosial\nBanyak beasiswa seperti LPDP, Chevening, dan Fulbright sangat menekankan rekam jejak kepemimpinan. Aktif berorganisasi, memimpin proyek sosial, atau berkontribusi di komunitas adalah nilai yang tidak bisa digantikan oleh IPK tinggi.\n\n2. Kejelasan Visi dan Misi\nApa yang ingin kamu capai dengan studi tersebut? Bagaimana hal itu akan berkontribusi pada masyarakat? Essay yang kuat tentang visi biasanya lebih berkesan dibanding transkrip sempurna.\n\n3. Kemampuan Bahasa Asing\nIni memang terukur, tapi bukan tentang IPK. Investasikan waktu untuk meningkatkan skor IELTS/TOEFL kamu.\n\n4. Proyek dan Portfolio Nyata\nUntuk beasiswa bidang teknologi, portofolio proyek nyata seringkali lebih berbicara dibanding nilai akademik.\n\nPesan akhir: Jangan biarkan IPK yang tidak sempurna menghalangi kamu mendaftar beasiswa impian. Fokus pada membangun keunggulan di aspek-aspek lain!",
                'poster'   => 'https://picsum.photos/seed/news5/800/500',
            ],
            [
                'title'    => 'Peluang Magang di Perusahaan Teknologi Top Indonesia 2026',
                'category' => 'Tech & Karir',
                'content'  => "Magang di perusahaan teknologi top adalah salah satu cara tercepat untuk membangun karir impian kamu. Berikut adalah informasi program magang dari perusahaan-perusahaan teknologi terkemuka yang biasanya membuka rekrutmen di tahun 2026:\n\nGojek/GoTo Group\nDivisi: Engineering, Product, Data Science\nPeriode: 3-6 bulan\nStipend: Rp 3.000.000 - 5.000.000/bulan\nCara daftar: careers.gotogroup.com\n\nTokopedia\nDivisi: Software Engineering, UI/UX, Data\nPeriode: 3-6 bulan\nStipend: Rp 2.500.000 - 4.000.000/bulan\nCara daftar: karir.tokopedia.com\n\nTraveloka\nDivisi: Backend, Frontend, Mobile, QA\nPeriode: 3 bulan\nStipend: Rp 3.500.000/bulan\nCara daftar: traveloka.com/karir\n\nShopee Indonesia\nDivisi: IT, Product, Data\nPeriode: 3-6 bulan\nStipend: Kompetitif\nCara daftar: careers.shopee.co.id\n\nTips Lolos Magang:\n1. Siapkan portfolio project yang bisa dilihat online (GitHub, Behance, dll)\n2. Latih kemampuan problem solving dengan LeetCode/HackerRank\n3. Manfaatkan jaringan alumni kampus yang bekerja di perusahaan tujuan\n4. Apply 3-4 bulan sebelum periode magang yang diinginkan",
                'poster'   => 'https://picsum.photos/seed/news6/800/500',
            ],
        ];

        foreach ($news as $index => $data) {
            $thumbnail = $data['poster'] ?? ('https://picsum.photos/seed/news' . $index . '/800/500');
            unset($data['poster']);
            News::create(array_merge($data, [
                'slug'      => Str::slug($data['title']) . '-' . rand(100, 999),
                'thumbnail' => $thumbnail,
                'status'    => 'published',
                'author_id' => $admin->id,
            ]));
        }
    }
}
