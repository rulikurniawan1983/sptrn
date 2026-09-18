@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        @include('base-page.header-show', [
            'backroute' => route($route . '.index', ['id_perikanan' => $item->id_perikanan]),
        ])
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-md-8">
                    <p class="small text-uppercase text-muted">Details</p>
                    <x-detail-item label="Jenis" :value="$item->berkas_perikanan->nama" />
                    <x-detail-item label="Nama" :value="$item->nama" />
                    <x-detail-item label="Tanggal" :value="$item->tanggal_berkas" />
                    <x-detail-item label="File Berkas">
                        @if ($item->file_berkas_url != null)
                            <a href="{{ $item->file_berkas_url }}" class="btn btn-info" target="_blank">Lihat File</a>
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
@push('styles')
@endpush
@push('script')
    <script>
        $(document).ready(function() {});
    </script>
@endpush
