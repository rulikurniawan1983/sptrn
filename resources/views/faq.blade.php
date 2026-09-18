@extends('layouts.app')

@section('title', $titlePage)

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h3 class="fw-bold mb-3">FAQ - Panduan Pengguna UMKM</h3>
                <p class="text-muted">Halaman ini berisi panduan lengkap untuk pengguna UMKM Perikanan dan Peternakan dalam mengelola produk serta menggunakan aplikasi SPARTAN.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-bottom p-4">
                <h5 class="mb-0 fw-bold"><i class="ti ti-fish text-primary me-1"></i> UMKM Perikanan</h5>
            </div>
            <div class="card-body p-4">
                <div class="accordion accordion-flush" id="faqPerikanan">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="perikanan-heading-1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#perikanan-collapse-1">
                                Bagaimana cara mendaftarkan produk perikanan?
                            </button>
                        </h2>
                        <div id="perikanan-collapse-1" class="accordion-collapse collapse show" data-bs-parent="#faqPerikanan">
                            <div class="accordion-body">
                                <ol>
                                    <li>Masuk ke menu <strong>Produk UMKM</strong> di dashboard.</li>
                                    <li>Klik tombol <strong>Tambah Produk Baru</strong>.</li>
                                    <li>Isi formulir dengan informasi lengkap: nama produk, harga, satuan, dan deskripsi.</li>
                                    <li>Unggah foto produk yang jelas dan menarik.</li>
                                    <li>Klik <strong>Simpan</strong> untuk mengirimkan produk ke verifikasi admin.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="perikanan-heading-2">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#perikanan-collapse-2">
                                Bagaimana cara melihat status verifikasi produk?
                            </button>
                        </h2>
                        <div id="perikanan-collapse-2" class="accordion-collapse collapse show" data-bs-parent="#faqPerikanan">
                            <div class="accordion-body">
                                <p>Status verifikasi produk dapat dilihat di halaman <strong>Daftar Produk Saya</strong>. Produk yang sedang menunggu verifikasi akan memiliki badge <span class="badge bg-label-warning">Menunggu Verifikasi</span>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="perikanan-heading-3">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#perikanan-collapse-3">
                                Bagaimana cara memperbarui data UMKM?
                            </button>
                        </h2>
                        <div id="perikanan-collapse-3" class="accordion-collapse collapse show" data-bs-parent="#faqPerikanan">
                            <div class="accordion-body">
                                <p>Untuk memperbarui data UMKM, klik menu <strong>Pengaturan Profil & Nomor WhatsApp</strong> di dashboard. Ubah informasi yang diperlukan dan simpan perubahan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-bottom p-4">
                <h5 class="mb-0 fw-bold"><i class="ti ti-building-store text-success me-1"></i> UMKM Peternakan</h5>
            </div>
            <div class="card-body p-4">
                <div class="accordion accordion-flush" id="faqPeternakan">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="peternakan-heading-1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#peternakan-collapse-1">
                                Bagaimana cara mendaftarkan produk peternakan?
                            </button>
                        </h2>
                        <div id="peternakan-collapse-1" class="accordion-collapse collapse show" data-bs-parent="#faqPeternakan">
                            <div class="accordion-body">
                                <ol>
                                    <li>Masuk ke menu <strong>Produk UMKM</strong> di dashboard.</li>
                                    <li>Klik tombol <strong>Tambah Produk Baru</strong>.</li>
                                    <li>Isi formulir dengan informasi lengkap: nama produk, harga, satuan, dan deskripsi.</li>
                                    <li>Unggah foto produk yang jelas dan menarik.</li>
                                    <li>Klik <strong>Simpan</strong> untuk mengirimkan produk ke verifikasi admin.</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="peternakan-heading-2">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#peternakan-collapse-2">
                                Bagaimana cara melihat status verifikasi produk?
                            </button>
                        </h2>
                        <div id="peternakan-collapse-2" class="accordion-collapse collapse show" data-bs-parent="#faqPeternakan">
                            <div class="accordion-body">
                                <p>Status verifikasi produk dapat dilihat di halaman <strong>Daftar Produk Saya</strong>. Produk yang sedang menunggu verifikasi akan memiliki badge <span class="badge bg-label-warning">Menunggu Verifikasi</span>.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="peternakan-heading-3">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#peternakan-collapse-3">
                                Bagaimana cara memperbarui data UMKM?
                            </button>
                        </h2>
                        <div id="peternakan-collapse-3" class="accordion-collapse collapse show" data-bs-parent="#faqPeternakan">
                            <div class="accordion-body">
                                <p>Untuk memperbarui data UMKM, klik menu <strong>Pengaturan Profil & Nomor WhatsApp</strong> di dashboard. Ubah informasi yang diperlukan dan simpan perubahan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-bottom p-4">
                <h5 class="mb-0 fw-bold"><i class="ti ti-bookmark text-info me-1"></i> Panduan Umum</h5>
            </div>
            <div class="card-body p-4">
                <div class="accordion accordion-flush" id="faqUmum">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="umum-heading-1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#umum-collapse-1">
                                Bagaimana cara login ke aplikasi SPARTAN?
                            </button>
                        </h2>
                        <div id="umum-collapse-1" class="accordion-collapse collapse show" data-bs-parent="#faqUmum">
                            <div class="accordion-body">
                                <p>Masukkan email dan password yang telah didaftarkan pada halaman login. Jika belum memiliki akun, silakan lakukan pendaftaran terlebih dahulu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="umum-heading-2">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#umum-collapse-2">
                                Bagaimana cara mengubah nomor WhatsApp?
                            </button>
                        </h2>
                        <div id="umum-collapse-2" class="accordion-collapse collapse show" data-bs-parent="#faqUmum">
                            <div class="accordion-body">
                                <p>Nomor WhatsApp dapat diubah melalui menu <strong>Pengaturan Profil & Nomor WhatsApp</strong> di dashboard. Pastikan nomor yang dimasukkan aktif dan dapat dihubungi.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="umum-heading-3">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#umum-collapse-3">
                                Apa yang harus dilakukan jika produk ditolak?
                            </button>
                        </h2>
                        <div id="umum-collapse-3" class="accordion-collapse collapse show" data-bs-parent="#faqUmum">
                            <div class="accordion-body">
                                <p>Jika produk ditolak, Anda akan menerima notifikasi. Perbaiki sesuai dengan catatan yang diberikan, kemudian ajukan kembali produk yang telah diperbarui.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="umum-heading-4">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#umum-collapse-4">
                                Bagaimana cara menghubungi admin?
                            </button>
                        </h2>
                        <div id="umum-collapse-4" class="accordion-collapse collapse show" data-bs-parent="#faqUmum">
                            <div class="accordion-body">
                                <p>Anda dapat menghubungi admin melalui kontak yang tersedia di halaman <strong>Informasi</strong> atau melalui notifikasi yang muncul di dashboard.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
