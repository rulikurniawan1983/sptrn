@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <x-profile-user active-tab="Profile">
        @php
            $auth_user = auth()->user();
        @endphp
        <div class="card shadow-sm mb-4">
            <h5 class="card-header">Deskripsi Profil</h5>
            <div class="card-body">
                {!! $auth_user->deskripsi !!}
            </div>
        </div>
    </x-profile-user>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/css/pages/page-profile.css" />
@endpush
@push('script')
    <script>
        $(document).ready(function() {});
    </script>
@endpush
