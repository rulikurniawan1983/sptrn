@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        @include('base-page.header-show')
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-md-8">
                    <p class="small text-uppercase text-muted">Details</p>
                    <x-detail-item label="Nama Pelaku Usaha" :value="$item->nama_pelaku_usaha ?? '-'" />
                    <x-detail-item label="Alamat" :value="$item->alamat ?? '-'" />
                    <x-detail-item label="Desa/Kelurahan" :value="$item->desa->nama ?? '-'" />
                    <x-detail-item label="Kecamatan" :value="$item->kecamatan->nama ?? '-'" />
                    <x-detail-item label="Jenis Kegiatan" :value="$item->jenis_kegiatan ?? '-'" />
                    <x-detail-item label="Produk Utama" :value="$item->produk_utama ?? '-'" />
                    <x-detail-item label="Jumlah Produksi/Bulan (Kg)" :value="$item->jumlah_produksi_bulan ?? '-'" />
                    <x-detail-item label="Harga Beli Bahan Baku (Rp/Kg)" :value="$item->harga_beli_bahan_baku ?? '-'" />
                    <x-detail-item label="Harga Jual Produk (Rp)" :value="$item->harga_jual_produk ?? '-'" />
                    <x-detail-item label="Wilayah Pemasaran" :value="$item->wilayah_pemasaran ?? '-'" />
                    <x-detail-item label="Legalitas" :value="$item->legalitas ?? '-'" />
                    <x-detail-item label="Kendala" :value="$item->kendala ?? '-'" />
                    <x-detail-item label="Berkelompok" :value="$item->berkelompok ? 'Ya' : 'Tidak'" />
                    <x-detail-item label="Nama Kelompok" :value="$item->nama_kelompok ?? '-'" />
                    <x-detail-item label="Foto Produk">
                        @if($item->foto_produk_url)
                            <a data-fslightbox="gallery" href="{{$item->foto_produk_url}}">
                                <img src="{{ $item->foto_produk_url }}" class="img-fluid rounded" style="max-width:200px;">
                            </a>
                        @else
                            -
                        @endif
                    </x-detail-item>
                </div>
                <div class="col-md-4">
                    <x-detail-list-action-time :item="$item" />
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('/') }}assets/vendor/libs/fslightbox/index.js"></script>
@endpush 