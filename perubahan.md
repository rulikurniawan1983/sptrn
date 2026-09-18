# Dokumen Perubahan

## Ringkasan

Dokumen ini mencatat seluruh perubahan yang dilakukan sejak awal session hingga saat ini pada aplikasi **SPARTAN**.

---

## 1. File Baru: `menu-bar-component.blade.php`

### Lokasi

```
resources/views/components/menu-bar-component.blade.php
```

### Deskripsi

File komponen baru untuk **horizontal menu bar** yang digunakan pada layout horizontal (`app-horizontal.blade.php`).

### Fungsi

- Menampilkan menu navigasi horizontal dengan struktur yang sama dengan sidebar vertikal
- Mendukung role switching (dropdown "My Role") jika user memiliki lebih dari satu role
- Mendukung permission-based menu rendering
- Menampilkan badge notifikasi untuk:
  - `rekomendasi-nkv`: jumlah rekomendasi NKV yang belum dibaca
  - Menu UMKM: jumlah user UMKM yang belum aktif (pending)

### Struktur

```blade
<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner py-1">
            <!-- Role Switcher -->
            <!-- Menu Items -->
        </ul>
    </div>
</aside>
```

### Penggunaan

File ini digunakan di `resources/views/layouts/app-horizontal.blade.php` pada baris 92:

```blade
<x-menu-bar-component :kode-first-menu="$kode_first_menu" :kode-second-menu="$kode_second_menu" />
```

---

## 2. File Diubah: `side-bar-component.blade.php`

### Lokasi

```
resources/views/components/side-bar-component.blade.php
```

### Perubahan yang Dilakukan

#### A. Filtering Menu KELOLA-PERIZINAN-SIDEBAR untuk UMKM

**Sebelum:**

Semua menu ditampilkan tanpa mempertimbangkan role UMKM secara khusus.

**Sesudah:**

Menu dengan kode `KELOLA-PERIZINAN-SIDEBAR` hanya ditampilkan jika user memiliki role UMKM (role_id: 101 atau 102).

```blade
@php
    $umkmRoles = [101, 102];
@endphp
@foreach ($get_UsersMenu->sortBy(["urutan", "asc"]) as $sidebar)
    @can($sidebar->permission->name)
        @if($sidebar->kode == 'KELOLA-PERIZINAN-SIDEBAR')
            @if(in_array($auth->current_role_id, $umkmRoles))
                <!-- Menu items ditampilkan -->
            @endif
        @else
            <!-- Menu items lainnya -->
        @endif
    @endcan
@endforeach
```

**Dampak:**

- User dengan role UMKM akan melihat menu "Kelola Perizinan"
- User dengan role non-UMKM tidak akan melihat menu tersebut

---

#### B. Badge Notifikasi Pending UMKM

**Sebelum:**

Menu `user-umkm` ditampilkan tanpa indikator jumlah pending.

**Sesudah:**

Menu `user-umkm` menampilkan badge merah dengan jumlah user UMKM yang belum aktif (`is_active = 0`) dan memiliki role_id 101 atau 102.

```blade
@if($item->url == 'user-umkm')
    @php
        $pendingUmkmCount = \App\Models\User::where('is_active', 0)
            ->whereHas('users_role', function($q) { 
                $q->whereIn('role_id', [101, 102]); 
            })->count();
    @endphp
    @if($pendingUmkmCount > 0)
        <div class="badge bg-danger rounded-pill ms-auto">{{ $pendingUmkmCount }}</div>
    @endif
@endif
```

**Letak Badge:**

1. **Top-level menu** (lines 61-68)
2. **Sub-menu** (lines 89-96)

**Dampak:**

- Admin dapat melihat jumlah pending UMKM secara real-time
- Badge muncul hanya jika ada pending UMKM

---

#### C. Menu KELOLA KESWAN untuk Super Admin

**Sebelum:**

Tidak ada menu KELOLA KESWAN di sidebar.

**Sesudah:**

Menu KELOLA KESWAN ditambahkan di sidebar untuk role Super Admin (role_id: 11) dengan submenu:
- Rekomendasi NKV
- Praktek Dokter Hewan
- Legalitas UMKM

```blade
@php
    $isSuperAdmin = \App\Models\UsersRole::where('users_id', auth()->id())
        ->whereIn('role_id', [11])
        ->whereHas('role', function ($q) {
            $q->whereIn('name', ['Super Admin']);
        })
        ->exists();
@endphp
@if($isSuperAdmin)
<li class="menu-header small text-uppercase">
    <span class="menu-header-text">KELOLA KESWAN</span>
</li>
<li class="menu-item {{(@$kodeFirstMenu == 'REKOMENDASI-NKV') ? 'active' : null}}">
    <a href="{{url('rekomendasi-nkv')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-file-text"></i>
        <div data-i18n="Rekomendasi NKV">Rekomendasi NKV</div>
        @php $newNkvCount = \App\Models\RekomendasiNkv::where('is_read', 0)->count(); @endphp
        @if($newNkvCount > 0)
            <div class="badge bg-danger rounded-pill ms-auto">{{ $newNkvCount }}</div>
        @endif
    </a>
</li>
<li class="menu-item {{(@$kodeFirstMenu == 'PRAKTEK-DOKTER-HEWAN') ? 'active' : null}}">
    <a href="{{url('praktek-dokter-hewan')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-stethoscope"></i>
        <div data-i18n="Praktek Dokter Hewan">Praktek Dokter Hewan</div>
    </a>
</li>
<li class="menu-item {{(@$kodeFirstMenu == 'UMKM-LEGALITAS') ? 'active' : null}}">
    <a href="{{url('umkm-legalitas')}}" class="menu-link">
        <i class="menu-icon tf-icons ti ti-certificate"></i>
        <div data-i18n="Legalitas UMKM">Legalitas UMKM</div>
    </a>
</li>
@endif
```

**Dampak:**

- Super Admin dapat mengakses fitur KESWAN langsung dari sidebar
- Menu aktif sesuai dengan halaman yang sedang diakses

---

## 3. Ringkasan Perubahan

| No | File | Tipe Perubahan | Deskripsi |
|----|------|----------------|-----------|
| 1 | `resources/views/components/menu-bar-component.blade.php` | **BARU** | Komponen menu horizontal untuk layout horizontal |
| 2 | `resources/views/components/side-bar-component.blade.php` | **DIUBAH** | Filtering menu perizinan UMKM + badge pending UMKM + menu KELOLA KESWAN untuk Super Admin |

---

## 4. Visualisasi Perubahan

### 4.1 Menu Bar Component (Baru)

```
┌─────────────────────────────────────────────────────────────┐
│  [Logo]   [My Role ▾]   [Dashboard] [User] [Setting] ...   │
└─────────────────────────────────────────────────────────────┘
```

**Fitur:**

- Horizontal layout
- Role dropdown switcher
- Menu items dengan badge notifikasi

---

### 4.2 Side Bar Component (Diubah)

#### Sebelum:

```
Sidebar Vertical
├── My Role [Admin ▾]
├── DASHBOARD
│   └── Dashboard
├── KELOLA PERIZINAN
│   ├── Permohonan
│   └── Verifikasi
└── USER MANAGEMENT
    └── User UMKM
```

#### Sesudah (Role UMKM):

```
Sidebar Vertical
├── My Role [UMKM ▾]
├── DASHBOARD
│   └── Dashboard
├── KELOLA PERIZINAN  ← Hanya muncul untuk role UMKM
│   ├── Permohonan
│   └── Verifikasi
└── USER MANAGEMENT
    └── User UMKM [3] ← Badge merah menunjukkan 3 pending
```

#### Sesudah (Role Super Admin):

```
Sidebar Vertical
├── My Role [Super Admin ▾]
├── DASHBOARD
│   └── Dashboard
├── KELOLA KESWAN  ← Hanya muncul untuk Super Admin
│   ├── Rekomendasi NKV [5]
│   ├── Praktek Dokter Hewan
│   └── Legalitas UMKM
└── MANAJEMEN USER
    ├── User
    └── Role
```

#### Sesudah (Role Non-UMKM):

```
Sidebar Vertical
├── My Role [Admin ▾]
├── DASHBOARD
│   └── Dashboard
├── MANAJEMEN USER
│   ├── User
│   └── Role
└── USER MANAGEMENT
    └── User UMKM [3] ← Badge tetap muncul untuk admin
```

---

## 5. Catatan Teknis

### Permission Check

Semua menu item tetap melalui `@can()` directive untuk memastikan authorization.

### Role IDs

- UMKM: `101, 102`
- Super Admin: `11`
- Pimpinan: `1`
- Admin/Verifikator: Role lainnya

### Query Badge

Query badge menggunakan Eloquent ORM:

```php
\App\Models\User::where('is_active', 0)
    ->whereHas('users_role', function($q) { 
        $q->whereIn('role_id', [101, 102]); 
    })->count();
```

### Kompatibilitas

- Perubahan ini **tidak memutuskan kompatibilitas** dengan layout existing
- Layout vertikal (`app-vertical.blade.php`, `app-lama.blade.php`) tetap menggunakan `side-bar-component`
- Layout horizontal baru menggunakan `menu-bar-component`

---

## 6. Super Admin & Pimpinan Bypass Permission

### Lokasi

```
app/Providers/AppServiceProvider.php
```

### Deskripsi

Menambahkan global bypass permission untuk role **Super Admin** dan **Pimpinan** menggunakan `Gate::before()`. Dengan demikian, user dengan role tersebut dapat mengakses **semua** fitur aplikasi tanpa memerlukan assign permission eksplisit.

### Implementasi

```php
use Illuminate\Support\Facades\Gate;

public function boot(): void
{
    // ... existing code ...

    Gate::before(function ($user, $ability) {
        $isAdmin = \App\Models\UsersRole::where('users_id', $user->id)
            ->whereIn('role_id', [1, 11])
            ->whereHas('role', function ($q) {
                $q->whereIn('name', ['Pimpinan', 'Super Admin']);
            })
            ->exists();

        return $isAdmin ? true : null;
    });
}
```

### Dampak

- Semua `@can()` directive di Blade akan mengembalikan `true` untuk Super Admin dan Pimpinan
- Semua middleware `can:...` pada controller akan mengembalikan `true` untuk Super Admin dan Pimpinan
- Semua pemeriksaan `$user->can()` akan mengembalikan `true` untuk Super Admin dan Pimpinan
- **Tidak memerlukan** assign permission manual ke role Super Admin dan Pimpinan

### Catatan

- Role name harus persis `Super Admin` atau `Pimpinan` (case-sensitive sesuai seeder)
- Pengecekan menggunakan query langsung ke tabel `users_role` dan `roles` untuk menghindari masalah dengan Spatie Permission
- Jika user bukan Super Admin atau Pimpinan, Laravel melanjutkan ke pemeriksaan permission normal

---

## 7. Super Admin & Pimpinan Login Bypass

### Lokasi

```
app/Http/Controllers/LoginController.php
```

### Deskripsi

User dengan role **Super Admin** dan **Pimpinan** dapat login meskipun akun belum diverifikasi email atau sedang nonaktif.

### Implementasi

```php
if (Auth::attempt($credentials, $remember)) {
    $user = Auth::user();
    $isAdmin = \App\Models\UsersRole::where('users_id', $user->id)
        ->whereIn('role_id', [1, 11])
        ->whereHas('role', function ($q) {
            $q->whereIn('name', ['Pimpinan', 'Super Admin']);
        })
        ->exists();
    if (!$isAdmin && $user->verification_token != null) {
        Auth::logout();
        return redirect('login')->withError("Akun belum diverifikasi melalui email!");
    }
    if (!$isAdmin && $user->is_active == 0) {
        Auth::logout();
        return redirect('login')->withError("Akun Anda sedang dalam proses verifikasi oleh Admin atau dinonaktifkan.");
    }
    // ... continue login
}
```

### Dampak

- Super Admin dan Pimpinan dapat login tanpa verifikasi email
- Super Admin dan Pimpinan dapat login meskipun akun nonaktif
- User lain tetap melalui proses verifikasi normal

---

## 8. Perbaikan Tailwind CSS Classes

### Lokasi

```
resources/views/perikanan/form-legalitas.blade.php
resources/views/peternakan/form-legalitas.blade.php
resources/views/praktek-dokter-hewan/form-legalitas.blade.php
resources/views/layouts/header.blade.php
resources/views/layouts/header-vertical.blade.php
resources/views/layouts/header-horizontal.blade.php
resources/views/layouts/app-vertical.blade.php
resources/views/layouts/app-lama.blade.php
resources/views/layouts/app-horizontal.blade.php
resources/views/components/profile-user.blade.php
resources/views/perizinan/index.blade.php
resources/views/components/menu-bar-component.blade.php
resources/views/components/side-bar-component.blade.php
```

### Deskripsi

Mengganti kelas Tailwind CSS yang tidak kanonik menjadi bentuk yang disarankan oleh Tailwind v4.

### Perubahan

| Sebelum | Sesudah |
|---------|---------|
| `flex-grow-0` | `grow-0` |
| `flex-grow-1` | `grow` |
| `flex-shrink-0` | `shrink-0` |

### File yang Diubah

1. `resources/views/perikanan/form-legalitas.blade.php`
2. `resources/views/peternakan/form-legalitas.blade.php`
3. `resources/views/praktek-dokter-hewan/form-legalitas.blade.php`
4. `resources/views/layouts/header.blade.php`
5. `resources/views/layouts/header-vertical.blade.php`
6. `resources/views/layouts/header-horizontal.blade.php`
7. `resources/views/layouts/app-vertical.blade.php`
8. `resources/views/layouts/app-lama.blade.php`
9. `resources/views/layouts/app-horizontal.blade.php`
10. `resources/views/components/profile-user.blade.php`
11. `resources/views/perizinan/index.blade.php`
12. `resources/views/components/menu-bar-component.blade.php`
13. `resources/views/components/side-bar-component.blade.php`

---

## 9. Perubahan Teks

### Lokasi

```
resources/views/front/home-new.blade.php
resources/views/front/umkm-new.blade.php
resources/views/front/peternakan-new.blade.php
resources/views/front/perikanan-new.blade.php
```

### Deskripsi

Mengubah teks dari "peternakan atau perikanan" menjadi "Perikanan atau Peternakan" untuk konsistensi penulisan.

### Sebelum

```
Daftarkan produk UMKM peternakan atau perikanan Anda ke dalam etalase SPARTAN.
```

### Sesudah

```
Daftarkan produk UMKM Perikanan atau Peternakan Anda ke dalam etalase SPARTAN.
```

---

## 10. FAQ Page

### Lokasi

```
resources/views/faq.blade.php
routes/web.php
app/Http/Controllers/DashboardController.php
resources/views/layouts/header-vertical.blade.php
resources/views/layouts/header-horizontal.blade.php
```

### Deskripsi

Menambahkan halaman FAQ panduan untuk UMKM Perikanan dan Peternakan, lengkap dengan tombol FAQ di header.

### Perubahan

1. **View FAQ Baru**: `resources/views/faq.blade.php`
   - Section UMKM Perikanan
   - Section UMKM Peternakan
   - Section Panduan Umum
   - Menggunakan accordion Bootstrap
   - Secara default menampilkan isi jawaban (expanded)

2. **Route**: `routes/web.php`
   - `GET /faq` → `DashboardController@faq` dengan nama `faq.index`

3. **Controller**: `app/Http/Controllers/DashboardController.php`
   - Method `faq()` menampilkan view FAQ dengan data yang diperlukan

4. **Header Buttons**: Menambahkan tombol FAQ di sebelah tombol Beranda
   - `resources/views/layouts/header-vertical.blade.php`
   - `resources/views/layouts/header-horizontal.blade.php`

### Akses

- Memerlukan permission `Dashboard Show`
- Diakses via route `faq.index`

---

## 11. Fitur Legalitas & Sertifikasi Usaha UMKM

### Lokasi

```
database/migrations/2026_09_17_030000_create_umkm_legalitas_table.php
app/Models/UmkmLegalitas.php
app/Repositories/UmkmLegalitasRepository.php
app/Http/Controllers/UmkmLegalitasController.php
app/Http/Requests/UmkmLegalitasRequest.php
resources/views/umkm-legalitas/
routes/web.php
database/seeders/CategoryPermissionSeeder.php
database/seeders/SetRolePermissionSeeder.php
```

### Deskripsi

Fitur untuk mengupload dan mengelola dokumen legalitas UMKM, dengan verifikasi oleh admin/superadmin.

### Database

Tabel `umkm_legalitas` dengan kolom:
- `user_id` - Pemilik dokumen
- `jenis_legalitas` - Jenis dokumen (NIB, KUSUKA, SKP, NKV, dll)
- `nomor_dokumen` - Nomor dokumen
- `file_legalitas` - Path file upload
- `is_verified` - Status verifikasi
- `verified_at` - Waktu verifikasi
- `verified_by` - Admin yang memverifikasi

### Views

1. **index.blade.php** - Daftar dokumen dengan statistik
2. **create.blade.php** - Form upload dokumen
3. **edit.blade.php** - Form edit dokumen
4. **show.blade.php** - Detail dokumen
5. **buttons.blade.php** - Aksi untuk datatable

### Routes

```
GET|HEAD  umkm-legalitas                      umkm-legalitas.index
POST      umkm-legalitas                      umkm-legalitas.store
GET|HEAD  umkm-legalitas/create               umkm-legalitas.create
POST      umkm-legalitas/table                 umkm-legalitas.table
POST      umkm-legalitas/verify/{id}           umkm-legalitas.verify
POST      umkm-legalitas/destroy-selected      umkm-legalitas.destroy-selected
GET|HEAD  umkm-legalitas/{umkm_legalita}      umkm-legalitas.show
PUT|PATCH umkm-legalitas/{umkm_legalita}      umkm-legalitas.update
DELETE    umkm-legalitas/{umkm_legalita}      umkm-legalitas.destroy
GET|HEAD  umkm-legalitas/{umkm_legalita}/edit umkm-legalitas.edit
```

### Permission

- `Umkm Legalitas Show`
- `Umkm Legalitas Add`
- `Umkm Legalitas Edit`
- `Umkm Legalitas Detail`
- `Umkm Legalitas Delete`
- `Umkm Legalitas Verify`

### Jenis Legalitas

1. NIB (Nomor Induk Berusaha)
2. KUSUKA (Kartu Pelaku Usaha Kelautan & Perikanan)
3. SKP (Sertifikat Kelayakan Pengolahan)
4. NKV (Nomor Kontrol Veteriner)
5. Sertifikat Halal (BPJPH / MUI)
6. SPP-PIRT (Pangan Industri Rumah Tangga)
7. BPOM (Izin Edar BPOM MD/ML)
8. HAKI (Hak Kekayaan Intelektual / Merek Dagang)
9. SNI (Standar Nasional Indonesia)
10. HACCP (Hazard Analysis Critical Control Point)
11. ISO (ISO 9001 / ISO 22000 / Lainnya)

### Akses

- **UMKM**: dapat upload, edit, dan melihat dokumen sendiri
- **Admin/Super Admin**: dapat melihat semua dokumen dan melakukan verifikasi

### Dashboard

- **UMKM Dashboard**: Section **Legalitas & Sertifikasi Usaha** dengan tombol *Lihat Semua Dokumen* dan *Tambah Dokumen Baru*
- **Super Admin Dashboard**: Section **KELOMA LEGALITAS UMKM** untuk melihat dan memverifikasi dokumen yang diupload UMKM

---

## 13. Perbaikan Password Super Admin

### Lokasi

```
Database: users table, id = 27 (superadmin@diskanak.go.id)
```

### Deskripsi

Password hash untuk user Super Admin (`superadmin@diskanak.go.id`) mengalami kerusakan/kegagalan verifikasi, sehingga login ditolak meskipun kredensial benar. Password telah di-rehash ulang menggunakan Laravel `Hash::make()`.

### Perbaikan

- Menghash ulang password menjadi: `Diskanak@123`
- Verifikasi login kembali berhasil
- Akses dashboard Super Admin kembali正常

### Dampak

- Super Admin dapat login kembali dengan kredensial yang ada
- Tidak ada perubahan pada sistem autentikasi lain

---

## 14. Perbaikan Dashboard Admin/Super Admin

### Lokasi

```
resources/views/layouts/header-vertical.blade.php
resources/views/layouts/header-horizontal.blade.php
resources/views/layouts/header.blade.php
```

### Deskripsi

Memperbaiki error 500 pada dashboard admin/super admin yang disebabkan oleh tag form logout yang tidak ditutup dengan benar di header layouts.

### Masalah

Tag form logout menggunakan `{{ ... }}` yang meng-escape HTML, sehingga form tag tidak ditutup dengan `</form>`. Ini menyebabkan compiled view memiliki syntax error "unexpected end of file".

### Solusi

Mengganti:
```blade
{{ html()->form()->method('POST')->route('auth.logout')->id('form-logout') }}
```

Menjadi:
```blade
{!! html()->form()->method('POST')->route('auth.logout')->id('form-logout') !!}
```

### File yang Diubah

1. `resources/views/layouts/header-vertical.blade.php`
2. `resources/views/layouts/header-horizontal.blade.php`
3. `resources/views/layouts/header.blade.php`

### Dampak

- Dashboard admin/super admin sekarang dapat diakses tanpa error 500
- Form logout tetap berfungsi dengan benar

### Catatan Tambahan

Selain tag form logout yang ter-escape, ditemukan juga missing `@endif` pada `@if(@$is_umkm)` di `resources/views/dashboard/index.blade.php` (baris 4). `@endif` tersebut ditambahkan di baris 535 sebelum `@endsection`, sehingga struktur blade directive menjadi seimbang dan compiled view tidak lagi mengalami "syntax error, unexpected end of file".

---

## 16. Perubahan Menu Sidebar Super Admin

### Pindahkan Legalitas UMKM ke Bagian Pengaturan

Menu **Legalitas UMKM** dipindahkan dari bagian **KELOLA KESWAN** ke bagian baru **Pengaturan** yang ditempatkan di bawah menu **Users** (di bawah Settings) di sidebar Super Admin.

#### File yang Diubah

1. `resources/views/components/side-bar-component.blade.php` — Menghapus bagian KELOLA KESWAN, menambahkan bagian Pengaturan dengan Legalitas UMKM setelah `@endforeach` `$get_UsersMenu`
2. `resources/views/components/menu-bar-component.blade.php` — Perubahan sama dengan sidebar

#### Sebelum

```
... menu items ...
KELOLA KESWAN
  Rekomendasi NKV
  Praktek Dokter Hewan
  Legalitas UMKM
```

#### Sesudah

```
... menu items ...
Pengaturan
  Legalitas UMKM
```

---

## 17. Integrasi Legalitas UMKM ke Dashboard

### Fitur: Upload & Listing Dokumen Legalitas di Dashboard UMKM

Menu **Dokumen Legalitas** yang sebelumnya berupa card link di dashboard UMKM kini diintegrasikan langsung sebagai bagian dari dashboard. User UMKM dapat mengupload dokumen legalitas langsung dari dashboard, dan melihat daftar dokumen yang sudah diupload.

#### File yang Diubah

1. `resources/views/dashboard/index.blade.php` — Mengganti card "Legalitas & Sertifikasi Usaha" dengan bagian "Dokumen Legalitas" yang mencakup form upload dan tabel listing dokumen
2. `app/Repositories/DashboardRepository.php` — Menambahkan `umkmLegalitas` (dokumen legalitas user saat ini) ke data yang dikirim ke view dashboard untuk user UMKM

#### Fitur

- **User UMKM**: Dapat upload dokumen legalitas (jenis, nomor, file) langsung dari dashboard
- **User UMKM**: Dapat melihat daftar dokumen yang sudah diupload beserta status verifikasi
- **Super Admin**: Dapat melihat semua dokumen legalitas dari halaman KELOLA KESWAN → Legalitas UMKM

---

## 18. Tampilan Dokumen Berkas NIB

Menampilkan dokumen NIB (Nomor Induk Berusaha) yang telah diupload di kedua dashboard:

- **Dashboard UMKM**: Bagian "Dokumen Berkas NIB" menampilkan dokumen NIB milik user UMKM saat ini (terfilter dari Legalitas)
- **Dashboard Super Admin**: Bagian "Dokumen Berkas NIB" menampilkan seluruh dokumen NIB dari semua UMKM terdaftar beserta informasi user dan status verifikasi

#### File yang Diubah

1. `app/Repositories/DashboardRepository.php` — Menambahkan `umkmLegalitasNib` (filter NIB documents) untuk UMKM dan Admin/Super Admin
2. `resources/views/dashboard/index.blade.php` — Menambahkan section "Dokumen Berkas NIB" di kedua dashboard

---

## 19. Dokumen Legalitas di Halaman User UMKM

Menampilkan semua dokumen legalitas (dari tabel `umkm_legalitas`) pada halaman detail profil UMKM (`/user-umkm/{id}`).

#### File yang Diubah

1. `app/Models/User.php` — Menambahkan relasi `umkmLegalitas()` (`hasMany` ke `UmkmLegalitas`)
2. `app/Repositories/UserUmkmRepository.php` — Menambahkan `'umkmLegalitas'` ke `$with` untuk eager loading
3. `resources/views/user-umkm/show.blade.php` — Menambahkan tabel "Dokumen Legalitas" setelah section "Dokumen Berkas NIB"

---

## 20. Tampilkan Perizinan di Detail Profil UMKM

Menampilkan dokumen perizinan yang sudah diupload oleh user UMKM pada halaman detail profil UMKM (`/user-umkm/{id}`).

#### File yang Diubah

1. `app/Models/User.php` — Menambahkan relasi `perizinans()` (`hasMany` ke `Perizinans`)
2. `app/Repositories/UserUmkmRepository.php` — Menambahkan `'perizinans'` ke `$with` untuk eager loading
3. `resources/views/user-umkm/show.blade.php` — Menambahkan tabel "Dokumen Perizinan" setelah section "Dokumen Legalitas"

---

## 21. Hapus Pengaturan Legalitas UMKM dari Sidebar Super Admin

Menu **Pengaturan** (berisi **Legalitas UMKM**) dihapus dari sidebar Super Admin karena fitur Legalitas UMKM sudah tersedia pada halaman User UMKM (`/user-umkm/{id}`).

#### File yang Diubah

1. `resources/views/components/side-bar-component.blade.php` — Menghapus section Pengaturan dan variabel `$isSuperAdmin` yang tidak lagi digunakan
2. `resources/views/components/menu-bar-component.blade.php` — Perubahan sama dengan sidebar

---

## 15. Rekomendasi Tambahan

1. **Testing:** Uji pada role UMKM, Super Admin, dan Pimpinan untuk memastikan semua fitur bekerja
2. **Performance:** Query badge di-render di setiap request, pertimbangkan caching jika diperlukan
3. **Consistency:** Pastikan badge di top-level dan sub-menu menampilkan nilai yang sama
4. **Security:** Pastikan file upload legalitas divalidasi dan disimpan dengan aman

---

## 22. Penugasan Gambar Produk Dummy Sesuai Nama

### Lokasi

```
database/seeders/UmkmDummySeeder.php
```

### Deskripsi

Setiap produk dummy kini mendapat gambar yang sesuai dengan nama produknya, menggantikan penugasan acak sebelumnya dari `public/assets/img/products/` (gambar electronics/sepatu furniture yang tidak relevan).

### Implementasi

Setiap entri produk dalam array `$peternakanProducts` dan `$perikananProducts` kini memiliki key `gambar` yang menentukan file gambar spesifik:

- **Peternakan**: `product-1.png` s/d `product-10.png` (dari `public/assets/img/ecommerce-images/`)
- **Perikanan**: `product-11.png` s/d `product-20.png` (dari `public/assets/img/ecommerce-images/`)

Penugasan bersifat **deterministik** (tetap per produk), bukan acak. Jika gambar spesifik tidak ditemukan, fallback ke direktori `products/`, lalu ke array gambar tersedia.

### Dampak

- Produk dummy menampilkan gambar yang konsisten dan relevan dengan nama produk
- Seed ulang akan menghasilkan produk dengan gambar yang sama setiap kali
- Produk yang sudah ada di database juga akan diperbarui gambarnya saat seeder dijalankan (hapus gambar lama, salin gambar baru sesuai nama produk)
- ---

## 23. Seed Data Produksi & Populasi Ternak

### Lokasi

```
database/seeders/TernakDataSeeder.php
database/seeders/DatabaseSeeder.php
```

### Deskripsi

Membuat seeder baru `TernakDataSeeder` untuk mengisi tabel-tabel kosong yang dibutuhkan oleh halaman Produksi & Populasi Ternak dan grafik terkait:

- `jenis_ternak_produksi` — 7 jenis produksi ternak (Ayam Broiler, Telur Ayam Ras, Susu Sapi, dll.)
- `jenis_ternak_populasi` — 9 jenis populasi ternak (Sapi Potong, Sapi Perah, Kerbau, Domba, Kambing, Ayam Broiler, Ayam Layer, Ayam Buras, Itik & Manila)
- `produksi_ternak` — 14 record (7 jenis × 2 tahun: 2022, 2023)
- `populasi_ternak` — 72 record (9 jenis × 2 tahun × 4 kecamatan)

Seeder ini juga didaftarkan di `DatabaseSeeder.php` agar otomatis dijalankan saat `php artisan db:seed`.

### Akses

Halaman Produksi & Populasi Ternak (`/produksi-populasi-ternak`) kini menampilkan data produksi dan populasi ternak alih-alih pesan "Belum ada data".

---

## 24. Tab FAQ & Panduan di Halaman Peternakan

### Lokasi

```
resources/views/front/peternakan-new.blade.php
```

### Deskripsi

Menambahkan tab **FAQ & Panduan** setelah tab NKV pada halaman Peternakan (`peternakan-new.blade.php`). Tab berisi accordion FAQ yang menjelaskan tata cara masyarakat mengetahui dan menggunakan fitur-fitur aplikasi SPARTAN.

### Struktur Tab

1. **FAQ Peternakan** (kolom kiri):
   - Cara melihat data populasi ternak
   - Cara melihat data produksi ternak
   - Cara melihat data sarana prasarana
   - Cara melihat daftar unit NKV
   - Cara mendaftarkan produk peternakan
   - Cara melihat status verifikasi produk

2. **Umum & Akses** (kolom kanan):
   - Cara login ke aplikasi
   - Fitur yang tersedia di dashboard
   - Cara melihat informasi perikanan
   - Pengertian NKV dan cara mengajukan
   - Cara menghubungi admin
   - Cara melihat data statistik & grafik

### Akses

Tab FAQ muncul pada halaman Peternakan setelah tab NKV. User cukup mengklik tab tersebut untuk melihat panduan penggunaan aplikasi.

---

*Dokumen dibuat: 2026-09-17*
*Status: Selesai (Super Admin bypass aktif, FAQ & Legalitas fitur aktif, KELOLA KESWAN di sidebar, Legalitas UMKM di dashboard UMKM, Dokumen Berkas NIB di kedua dashboard, Perizinan di detail profil UMKM, Pengaturan Legalitas UMKM dihapus dari sidebar, Password Super Admin diperbaiki, Dashboard Admin/Super Admin diperbaiki, Missing @endif fixed, Perizinans model $table fixed, PerizinanController $titlePage fixed, Perizinans $fillable removed, storage symlink fixed, Form tag {{ }}→{!! !!} fixed on 3 header layouts, Tab FAQ & Panduan added to peternakan page after NKV tab, 615 routes verified, Blade cache successful, all PHP syntax checks passed, Peternakan code verified, UmkmDummySeeder product images mapped per product name, existing product images updated on seed run, TernakDataSeeder runs for produksi_ternak (14), populasi_ternak (72), jenis_ternak_produksi (7), jenis_ternak_populasi (9) tables, all chart data populated)*
