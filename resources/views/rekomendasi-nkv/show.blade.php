@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        @include('base-page.header-show')
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-md-8">
                    <p class="small text-uppercase text-muted">Details</p>
                    <x-detail-item label="Nama Pemohon" :value="$item->nama_pemohon ?? '-'" />
                    <x-detail-item label="Nama Tempat Usaha" :value="$item->nama_tempat_usaha ?? '-'" />
                    <x-detail-item label="Alamat Usaha" :value="$item->alamat_usaha ?? '-'" />
                    <x-detail-item label="Email" :value="$item->email ?? '-'" />
                    <x-detail-item label="No. HP" :value="$item->no_hp ?? '-'" />
                    <x-detail-item label="NIB">
                        @php $nibUrl = $item->getFirstMediaUrl('nib'); @endphp
                        @if($nibUrl)
                            <a href="{{ $nibUrl }}" target="_blank">Lihat File</a>
                        @else
                            -
                        @endif
                    </x-detail-item>
                    <x-detail-item label="Surat Permohonan">
                        @php $spUrl = $item->getFirstMediaUrl('surat_permohonan'); @endphp
                        @if($spUrl)
                            <a href="{{ $spUrl }}" target="_blank">Lihat File</a>
                        @else
                            -
                        @endif
                    </x-detail-item>
                    <x-detail-item label="Data Umum">
                        @php $duUrl = $item->getFirstMediaUrl('data_umum'); @endphp
                        @if($duUrl)
                            <a href="{{ $duUrl }}" target="_blank">Lihat File</a>
                        @else
                            -
                        @endif
                    </x-detail-item>
                    <x-detail-item label="SOP Sanitasi">
                        @php $sopUrl = $item->getFirstMediaUrl('sop_sanitasi'); @endphp
                        @if($sopUrl)
                            <a href="{{ $sopUrl }}" target="_blank">Lihat File</a>
                        @else
                            -
                        @endif
                    </x-detail-item>
                    <x-detail-item label="Surat Pernyataan">
                        @php $spnUrl = $item->getFirstMediaUrl('surat_pernyataan'); @endphp
                        @if($spnUrl)
                            <a href="{{ $spnUrl }}" target="_blank">Lihat File</a>
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
@push('styles')
@endpush
@push('script')
    <script>
        $(document).ready(function() {});
    </script>
@endpush 