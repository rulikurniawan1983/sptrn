@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        @include('base-page.header-show', [
            'backroute' => route($route . '.index', ['id_peternakan' => $item->id_peternakan]),
        ])
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-md-8">
                    <p class="small text-uppercase text-muted">Details</p>
                    <x-detail-item label="Tanggal" :value="periodeTanggal($item->tanggal_produksi_dari, $item->tanggal_produksi_sampai)" />
                    <x-detail-item label="Jumlah Kandang">{{$item->jumlah_kandang}} {{$item->satuan_kandang->nama}}</x-detail-item>
                    <x-detail-item label="Jumlah Populasi">{{$item->jumlah_populasi}} {{$item->satuan_populasi->nama}}</x-detail-item>
                    <x-detail-item label="Jumlah Produksi">{{$item->jumlah_produksi}} {{$item->satuan_produksi->nama}}</x-detail-item>
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
