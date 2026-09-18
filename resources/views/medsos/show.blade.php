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
                    <x-detail-item label="Url" :value="$item->url"></x-detail-item>
                    <x-detail-item label="Icon">
                        {!! $item->icon !!}
                    </x-detail-item>
                    <x-detail-item label="Status">
                        {!! $item->is_active_badge !!}
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
