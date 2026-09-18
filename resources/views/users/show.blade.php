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
                    <x-detail-item label="Nama Pemilik" :value="$item->nama_pemilik"></x-detail-item>
                    <x-detail-item label="No. HP" :value="$item->no_hp"></x-detail-item>
                    <x-detail-item label="Email" :value="$item->email"></x-detail-item>
                    <x-detail-item label="Deskrispi" :value="$item->deskripsi"></x-detail-item>
                    <x-detail-item label="Status">
                        {!! $item->is_active_badge !!}
                    </x-detail-item>
                    @if($item->nib_file_url)
                    <x-detail-item label="Berkas NIB">
                        <a href="{{ $item->nib_file_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="ti ti-file-description me-1"></i> Lihat / Unduh Berkas NIB
                        </a>
                    </x-detail-item>
                    @endif
                    <x-detail-item label="Level Terdaftar">
                        @foreach ($item->users_role as $value)
                            <span class="badge bg-success">
                                {{ $value->role->name }}
                            </span>
                        @endforeach
                    </x-detail-item>
                </div>
                <div class="col-md-4">
                    <p class="small text-uppercase text-muted">Foto</p>
                    <div class="col-8 col-lg-5 col-xl-5 col-md-6 col-sm-6 mx-auto mb-3">
                        <img src="{{ $item->file_url }}" alt="" class="w-100">
                    </div>
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
