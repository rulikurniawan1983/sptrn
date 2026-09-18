@extends('layouts.front-new.app')
@section('title', @$meta_title)
@section('meta_description', @$meta_description)
@section('body_class', 'page-production-livestock')
@section('data_page', 'production-livestock')

@section('content')
<section class="page-hero livestock">
    <video class="hero-video" autoplay loop muted playsinline>
        <source src="{{ asset('assets-front-new/images/peternakan.webm') }}" type="video/webm">
    </video>
    <div class="container page-hero-inner">
        <div class="breadcrumbs"><a href="{{ route('front.home.index') }}">Beranda</a><span>›</span><span>Produksi & Populasi Ternak</span></div>
        <span class="page-kicker">Data & Statistik</span>
        <h1>Produksi & Populasi Ternak</h1>
        <p>Statistik data produksi dan populasi ternak Kabupaten Bogor.</p>
    </div>
</section>

<!-- Produksi Ternak Section -->
<section id="data-produksi-section" class="section categories category-data-section py-5" style="background: white;">
    <div class="container">
        <div class="category-grid single-category-grid mb-4">
            <article class="category-card data-category-card stats-category-card" style="width: 100%;">
                <div class="category-heading"><span class="big-icon">📦</span>
                    <div>
                        <h2>Data Produksi Ternak</h2>
                        <p>Data total produksi hasil ternak berdasarkan jenis komoditas pertahun di Kabupaten Bogor.</p>
                    </div>
                </div>
            </article>
        </div>

        @if(isset($listProduksiTernak) && $listProduksiTernak->count() > 0)
            <div style="overflow-x: auto; background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: 1px solid #eef2f5;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background: #15963a; color: white;">
                            <th style="padding: 15px; font-weight: 600;">No</th>
                            <th style="padding: 15px; font-weight: 600;">Jenis Ternak</th>
                            <th style="padding: 15px; font-weight: 600;">Tahun</th>
                            <th style="padding: 15px; font-weight: 600; text-align: right;">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listProduksiTernak as $index => $produksi)
                            <tr style="border-bottom: 1px solid #eef2f5;">
                                <td style="padding: 15px;">{{ $index + 1 }}</td>
                                <td style="padding: 15px; font-weight: 600;">{{ $produksi->jenis_ternak_produksi->nama ?? '-' }}</td>
                                <td style="padding: 15px;">
                                    <span style="background: rgba(21, 150, 58, 0.1); color: #15963a; padding: 4px 10px; border-radius: 20px; font-size: 0.85em; font-weight: 600;">
                                        {{ $produksi->tahun ?? '-' }}
                                    </span>
                                </td>
                                <td style="padding: 15px; text-align: right; font-weight: 700;">{{ number_format($produksi->jumlah ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 40px; background: #fafafa; border-radius: 12px; border: 1px dashed #ccc;">
                <p>Belum ada data produksi ternak yang tersedia.</p>
            </div>
        @endif
    </div>
</section>

<!-- Populasi Ternak Section -->
<section id="data-populasi-section" class="section categories category-data-section py-5" style="background: #f8fafc; border-top: 1px solid #e2e8f0;">
    <div class="container">
        <div class="category-grid single-category-grid mb-4">
            <article class="category-card data-category-card stats-category-card" style="width: 100%;">
                <div class="category-heading"><span class="big-icon">🐄</span>
                    <div>
                        <h2>Data Populasi Ternak</h2>
                        <p>Data populasi hewan ternak Kabupaten Bogor.</p>
                    </div>
                </div>
            </article>
        </div>

        @if(isset($listPopulasiTernak) && $listPopulasiTernak->count() > 0)
            <div style="overflow-x: auto; background: white; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: 1px solid #eef2f5;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background: #0878bd; color: white;">
                            <th style="padding: 15px; font-weight: 600;">No</th>
                            <th style="padding: 15px; font-weight: 600;">Jenis Ternak</th>
                            <th style="padding: 15px; font-weight: 600;">Tahun</th>
                            <th style="padding: 15px; font-weight: 600; text-align: right;">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($listPopulasiTernak as $index => $populasi)
                            <tr style="border-bottom: 1px solid #eef2f5;">
                                <td style="padding: 15px;">{{ $index + 1 }}</td>
                                <td style="padding: 15px; font-weight: 600;">{{ $populasi->jenis_ternak_populasi->nama ?? '-' }}</td>
                                <td style="padding: 15px;">
                                    <span style="background: rgba(8, 120, 189, 0.1); color: #0878bd; padding: 4px 10px; border-radius: 20px; font-size: 0.85em; font-weight: 600;">
                                        {{ $populasi->tahun ?? '-' }}
                                    </span>
                                </td>
                                <td style="padding: 15px; text-align: right; font-weight: 700;">{{ number_format($populasi->jumlah ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="text-align: center; padding: 40px; background: #fafafa; border-radius: 12px; border: 1px dashed #ccc;">
                <p>Belum ada data populasi ternak yang tersedia.</p>
            </div>
        @endif
    </div>
</section>
@endsection
