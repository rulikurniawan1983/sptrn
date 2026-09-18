@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <x-tab-praktek-dokter-hewan-component :is-lock="true" :active-tab="$section" />
    @include($route . '.' . $section)
@endsection
@push('styles')
@endpush
@push('script')
    <script>
        $(document).ready(function() {});
    </script>
@endpush
