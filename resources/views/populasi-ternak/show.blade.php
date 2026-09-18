@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        @include('base-page.header-show')
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-lg-8">
                    <p class="small text-uppercase text-muted">Details</p>
                    <x-detail-item label="Jenis Ternak Populasi" :value="$item->jenis_ternak_populasi->nama ?? '-'" />
                    <x-detail-item label="Tahun" :value="$item->tahun ?? '-'" />
                    <x-detail-item label="Jumlah" :value="$item->jumlah ?? '-'" />
                    <x-detail-item label="Kecamatan" :value="$item->kecamatan->nama ?? '-'" />
                    <x-detail-item label="RTP" :value="$item->rtp ?? '-'" />
                </div>
                <div class="col-lg-4">
                    <x-detail-list-action-time :item="$item" />
                </div>
            </div>
        </div>
    </div>
@endsection 