@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        @include('base-page.header-show', [
            'backroute' => route($route . '.index', ['id_status_penyakit' => $item->id_status_penyakit]),
        ])
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-md-8">
                    <p class="small text-uppercase text-muted">Details</p>
                    <x-detail-item label="Tahun" :value="$item->tahun" />
                    <x-detail-item label="Nama Hewan" :value="$item->status_penyakit_hewan->nama_hewan" />
                    <x-detail-item label="Jumlah Terinfeksi" :value="$item->jumlah_terinfeksi" />
                    <x-detail-item label="Jumlah Sembuh" :value="$item->jumlah_sembuh" />
                    <x-detail-item label="Jumlah Mati" :value="$item->jumlah_mati" />
                </div>
                <div class="col-md-4">
                    <x-detail-list-action-time :item="$item" />
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
@endpush
@push('script')
    <script>
        $(document).ready(function() {});
    </script>
@endpush
