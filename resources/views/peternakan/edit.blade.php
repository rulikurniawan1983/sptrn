@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <x-tab-peternakan-component :item="$item" :is-lock="false" :active-tab="$section" />
    @include($route . '.' . $section)
@endsection
@push('styles')
@endpush
@push('script')
    <script>
        $(document).ready(function() {});
    </script>
@endpush
