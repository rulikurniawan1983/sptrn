@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        @include('base-page.header-show')
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-md-8">
                    <p class="small text-uppercase text-muted">Details</p>
                    <x-detail-item label="Nama" :value="$item->name"></x-detail-item>
                    <x-detail-item label="Warna">{!! $item->bg_badge !!}</x-detail-item>
                    <x-detail-item label="Halaman Setelah Login" :value="$item->init_page_login"></x-detail-item>
                    <x-detail-item label="Status Login">
                        {!! $item->is_allow_login_badge !!}
                    </x-detail-item>
                    <x-detail-item label="Menu Aplikasi">
                        {!! $item->is_vertical_menu_badge !!}
                    </x-detail-item>
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
