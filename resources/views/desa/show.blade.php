@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        @include('base-page.header-show')
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-md-8">
                    <p class="small text-uppercase text-muted">Details</p>
                    <x-detail-item label="Nama" :value="$item->nama"></x-detail-item>
                    <x-detail-item label="Kecamatan" :value="$item->kecamatan->nama"></x-detail-item>
                    <x-detail-item label="Latitude" :value="$item->latitude"></x-detail-item>
                    <x-detail-item label="Longitude" :value="$item->longitude"></x-detail-item>
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
