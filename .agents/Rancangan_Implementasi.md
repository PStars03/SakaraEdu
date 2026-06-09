# Rancangan Implementasi SakaraEdu — Laravel 13 + Livewire

## 1. Ringkasan Perubahan

Dokumen ini memperbarui rancangan SakaraEdu dengan tambahan:

1. Frontend menggunakan Livewire.
2. Bootcamp memiliki harga jika berbayar.
3. Bootcamp gratis menampilkan tulisan `Free`.
4. Logo web menggunakan asset SakaraEdu yang disediakan.
5. Desain frontend mengikuti warna logo.
6. Tema dibuat simpel, kekinian, ramah Gen Z, dan memiliki animasi ringan.

## 2. Install Livewire

Jika Livewire belum tersedia, jalankan:

```bash
composer require livewire/livewire
```

Publish asset jika diperlukan:

```bash
php artisan livewire:publish --config
```

Tambahkan pada layout Blade utama:

```blade
@livewireStyles

@vite(['resources/css/app.css', 'resources/js/app.js'])
```

Sebelum `</body>`:

```blade
@livewireScripts
```

## 3. Asset Logo

Salin logo ke:

```text
public/images/sakaraedu-logo-horizontal.png
public/images/sakaraedu-logo-icon.png
```

Gunakan logo horizontal di navbar:

```blade
<a href="{{ route('home') }}" class="flex items-center gap-3">
    <img src="{{ asset('images/sakaraedu-logo-horizontal.png') }}" alt="SakaraEdu" class="h-12 w-auto">
</a>
```

Gunakan logo ikon di sidebar:

```blade
<img src="{{ asset('images/sakaraedu-logo-icon.png') }}" alt="SakaraEdu Icon" class="h-10 w-10">
```

## 4. Update Tailwind CSS v4

Edit `resources/css/app.css`:

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

## 5. Update Migration Bootcamp

Tambahkan field:

```php
$table->boolean('is_paid')->default(false);
$table->decimal('price', 15, 2)->nullable();
```

Jika tabel bootcamps sudah dibuat, buat migration baru:

```bash
php artisan make:migration add_price_fields_to_bootcamps_table
```

Isi migration:

```php
Schema::table('bootcamps', function (Blueprint $table) {
    $table->boolean('is_paid')->default(false)->after('status');
    $table->decimal('price', 15, 2)->nullable()->after('is_paid');
});
```

Rollback:

```php
Schema::table('bootcamps', function (Blueprint $table) {
    $table->dropColumn(['is_paid', 'price']);
});
```

## 6. Update Model Bootcamp

Tambahkan fillable:

```php
protected $fillable = [
    'title',
    'slug',
    'organizer',
    'start_date',
    'end_date',
    'location',
    'description',
    'requirements',
    'curriculum',
    'poster',
    'registration_link',
    'status',
    'is_paid',
    'price',
    'created_by',
];
```

Tambahkan casts:

```php
protected function casts(): array
{
    return [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_paid' => 'boolean',
        'price' => 'decimal:2',
    ];
}
```

Tambahkan accessor harga:

```php
public function getFormattedPriceAttribute(): string
{
    if (! $this->is_paid) {
        return 'Free';
    }

    return 'Rp' . number_format((float) $this->price, 0, ',', '.');
}
```

## 7. Update Validasi Bootcamp

Pada request/controller validasi:

```php
return [
    'title' => ['required', 'string', 'max:255'],
    'organizer' => ['required', 'string', 'max:255'],
    'start_date' => ['required', 'date'],
    'end_date' => ['required', 'date', 'after_or_equal:start_date'],
    'location' => ['required', 'string', 'max:255'],
    'description' => ['required', 'string'],
    'requirements' => ['nullable', 'string'],
    'curriculum' => ['nullable', 'string'],
    'poster' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
    'registration_link' => ['required', 'url'],
    'status' => ['required', 'in:draft,published'],
    'is_paid' => ['required', 'boolean'],
    'price' => ['nullable', 'numeric', 'min:1000', 'required_if:is_paid,1'],
];
```

Sebelum menyimpan:

```php
$data['price'] = $request->boolean('is_paid') ? $request->price : null;
```

## 8. Livewire Components

Buat komponen:

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

## 9. PublicBootcampList

Fitur:

1. Search bootcamp.
2. Filter semua/free/berbayar.
3. Pagination.
4. Loading skeleton.
5. Badge harga.

State:

```php
public string $search = '';
public string $priceFilter = 'all';
```

Query:

```php
$bootcamps = Bootcamp::query()
    ->where('status', 'published')
    ->when($this->search, function ($query) {
        $query->where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('organizer', 'like', '%' . $this->search . '%');
        });
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

## 10. Bootcamp Card

```blade
<div class="card-hover rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
    @if ($bootcamp->poster)
        <img src="{{ Storage::url($bootcamp->poster) }}" alt="{{ $bootcamp->title }}" class="h-44 w-full rounded-xl object-cover">
    @else
        <div class="flex h-44 items-center justify-center rounded-xl bg-soft-bg">
            <img src="{{ asset('images/sakaraedu-logo-icon.png') }}" alt="SakaraEdu" class="h-16 w-16 opacity-80">
        </div>
    @endif

    <div class="mt-4 flex items-start justify-between gap-3">
        <div>
            <h3 class="text-lg font-bold text-deep-navy">{{ $bootcamp->title }}</h3>
            <p class="mt-1 text-sm text-slate-text">{{ $bootcamp->organizer }}</p>
        </div>

        @if ($bootcamp->is_paid)
            <span class="rounded-full bg-sky-blue/10 px-3 py-1 text-xs font-semibold text-primary-blue">
                {{ $bootcamp->formatted_price }}
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

## 11. Form Bootcamp Admin

Tambahkan input:

```blade
<div>
    <label class="flex items-center gap-2">
        <input type="checkbox" name="is_paid" value="1" @checked(old('is_paid', $bootcamp->is_paid ?? false))>
        <span>Bootcamp berbayar</span>
    </label>
</div>

<div>
    <label for="price" class="block text-sm font-semibold text-deep-navy">Harga Bootcamp</label>
    <input
        type="number"
        name="price"
        id="price"
        value="{{ old('price', $bootcamp->price ?? '') }}"
        class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-primary-blue focus:ring-primary-blue"
        placeholder="Contoh: 150000"
    >
    <p class="mt-1 text-xs text-slate-text">Kosongkan jika bootcamp gratis.</p>
</div>
```

Lebih baik gunakan Livewire agar input harga muncul hanya saat checkbox berbayar aktif.

## 12. Dashboard UI

Dashboard harus memakai:

1. Sidebar deep navy.
2. Logo icon di atas.
3. Active menu gradient blue-green.
4. Summary card rounded-2xl.
5. Table dengan Livewire.
6. Search tanpa reload.
7. Empty state memakai logo icon.

## 13. Testing Tambahan

Tambahkan test:

1. Free bootcamp stores `is_paid = false`.
2. Paid bootcamp requires price.
3. Paid bootcamp displays Rupiah price.
4. Free bootcamp displays `Free`.
5. Public bootcamp Livewire filter can filter free bootcamps.
6. Public bootcamp Livewire filter can filter paid bootcamps.

## 14. Final Command

Sebelum submit:

```bash
./vendor/bin/pint
composer test
npm run build
```

Kalau ketiganya lolos, baru boleh bilang selesai. Kalau belum, itu bukan selesai. Itu baru “semoga dosen tidak klik terlalu jauh”.
