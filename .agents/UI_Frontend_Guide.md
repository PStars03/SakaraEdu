# SakaraEdu UI Frontend Guide — Logo, Livewire, Warna, dan Animasi

## 1. Arah Visual

Frontend SakaraEdu menggunakan gaya:

1. Simpel.
2. Modern.
3. Bersih.
4. Kekinian untuk Gen Z.
5. Profesional untuk konteks edukasi.
6. Menggunakan warna logo.
7. Memiliki animasi ringan agar tidak monoton.

Konsep visual utama: education growth platform.

Makna visual dari logo:

1. Toga melambangkan pendidikan.
2. Panah hijau melambangkan pertumbuhan dan progres.
3. Bentuk biru melambangkan teknologi, kepercayaan, dan akses edukasi.
4. Warna hijau melambangkan kesempatan, perkembangan, dan optimisme.

## 2. Asset Logo

Gunakan file:

```text
public/images/sakaraedu-logo-horizontal.png
public/images/sakaraedu-logo-icon.png
```

Penggunaan:

| Asset | Lokasi |
|---|---|
| Logo horizontal | Navbar, landing page, login/register, footer |
| Logo icon | Favicon, sidebar collapsed, loading, empty state |

Contoh Blade:

```blade
<img src="{{ asset('images/sakaraedu-logo-horizontal.png') }}" alt="SakaraEdu" class="h-12 w-auto">
```

## 3. Palet Warna

```css
@import "tailwindcss";

@theme {
    --color-primary-blue: #005F9E;
    --color-sky-blue: #12A8E8;
    --color-deep-navy: #172B5F;
    --color-fresh-green: #7ACB00;
    --color-dark-green: #057A2E;
    --color-soft-bg: #F8FBFF;
    --color-slate-text: #334155;
}
```

## 4. Komposisi Warna

### Navbar

- Background putih transparan atau putih solid.
- Logo kiri.
- Link warna deep navy.
- Hover warna primary blue.
- Tombol login/register menggunakan primary blue atau fresh green.

### Hero Section

- Background soft blue/white gradient.
- Judul besar warna deep navy.
- Kata penting boleh memakai gradient blue-green.
- CTA utama warna fresh green.
- CTA sekunder outline primary blue.

### Card

- Background putih.
- Border abu-abu tipis.
- Shadow halus.
- Rounded-2xl.
- Hover lift.

### Dashboard

- Sidebar deep navy.
- Active menu memakai gradient blue-green.
- Card statistik memakai background putih.
- Icon memakai primary blue atau fresh green.

## 5. Animasi

Tambahkan di `resources/css/app.css`:

```css
@import "tailwindcss";

@theme {
    --color-primary-blue: #005F9E;
    --color-sky-blue: #12A8E8;
    --color-deep-navy: #172B5F;
    --color-fresh-green: #7ACB00;
    --color-dark-green: #057A2E;
    --color-soft-bg: #F8FBFF;
    --color-slate-text: #334155;
}

@keyframes fade-up {
    from {
        opacity: 0;
        transform: translateY(18px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes soft-float {
    0%, 100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-8px);
    }
}

.animate-fade-up {
    animation: fade-up 0.6s ease-out both;
}

.animate-soft-float {
    animation: soft-float 4s ease-in-out infinite;
}

.card-hover {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.card-hover:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgb(15 23 42 / 0.10);
}
```

## 6. Komponen Bootcamp Card

Bootcamp harus menampilkan harga.

```blade
<div class="card-hover rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
    <img src="{{ Storage::url($bootcamp->poster) }}" alt="{{ $bootcamp->title }}" class="h-44 w-full rounded-xl object-cover">

    <div class="mt-4 flex items-start justify-between gap-3">
        <div>
            <h3 class="text-lg font-bold text-deep-navy">{{ $bootcamp->title }}</h3>
            <p class="mt-1 text-sm text-slate-text">{{ $bootcamp->organizer }}</p>
        </div>

        @if ($bootcamp->is_paid)
            <span class="rounded-full bg-sky-blue/10 px-3 py-1 text-xs font-semibold text-primary-blue">
                Rp{{ number_format($bootcamp->price, 0, ',', '.') }}
            </span>
        @else
            <span class="rounded-full bg-fresh-green/10 px-3 py-1 text-xs font-semibold text-dark-green">
                Free
            </span>
        @endif
    </div>

    <p class="mt-3 line-clamp-2 text-sm text-slate-text">
        {{ $bootcamp->description }}
    </p>

    <a href="{{ route('bootcamps.show', $bootcamp) }}" class="mt-5 inline-flex rounded-xl bg-primary-blue px-4 py-2 text-sm font-semibold text-white transition hover:bg-deep-navy">
        Lihat Detail
    </a>
</div>
```

## 7. Livewire Bootcamp Filter

Komponen `PublicBootcampList` harus memiliki:

1. Search keyword.
2. Filter harga:
   - `all`
   - `free`
   - `paid`
3. Pagination.
4. Loading state.

Contoh state:

```php
public string $search = '';
public string $priceFilter = 'all';
```

Query logic:

```php
Bootcamp::query()
    ->where('status', 'published')
    ->when($this->search, function ($query) {
        $query->where('title', 'like', '%' . $this->search . '%')
            ->orWhere('organizer', 'like', '%' . $this->search . '%');
    })
    ->when($this->priceFilter === 'free', function ($query) {
        $query->where('is_paid', false);
    })
    ->when($this->priceFilter === 'paid', function ($query) {
        $query->where('is_paid', true);
    })
    ->latest()
    ->paginate(9);
```

## 8. Livewire Loading State

Contoh:

```blade
<div wire:loading class="grid gap-6 md:grid-cols-3">
    @for ($i = 0; $i < 3; $i++)
        <div class="h-72 animate-pulse rounded-2xl bg-slate-100"></div>
    @endfor
</div>

<div wire:loading.remove>
    {{-- data cards --}}
</div>
```

## 9. Landing Page Section

Struktur landing page:

1. Navbar dengan logo.
2. Hero section.
3. Highlight fitur:
   - Beasiswa
   - Bootcamp
   - Manajemen Uang
   - Berita
4. Beasiswa terbaru.
5. Bootcamp terbaru.
6. Berita terbaru.
7. CTA register.
8. Footer.

Copywriting hero:

```text
Temukan Beasiswa, Ikuti Bootcamp, dan Kelola Dana Pendidikanmu dalam Satu Platform.
```

Subheading:

```text
SakaraEdu membantu mahasiswa mencari peluang belajar, menemukan program pengembangan skill, dan mengatur dana beasiswa dengan lebih rapi.
```

CTA:

```text
Mulai Sekarang
Lihat Beasiswa
```

## 10. Catatan Implementasi

1. Jangan terlalu banyak animasi.
2. Pastikan UI mobile-friendly.
3. Pastikan kontras warna tetap terbaca.
4. Jangan menampilkan konten draft ke halaman publik.
5. Gunakan Livewire hanya pada bagian yang butuh interaksi.
6. Detail page cukup Blade biasa.
7. Gunakan format Rupiah untuk bootcamp berbayar.
8. Jika bootcamp gratis, tampilkan label `Free`, bukan `Rp0`.
