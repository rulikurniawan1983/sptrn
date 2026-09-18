@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="row">
        <div class="{{ @$col ? @$col : "col-lg-7" }}">
            <div class="card shadow-sm">
                <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ __('message.add') }} {{ $titlePage }}</h5>
                    <div class="mt-2 mt-md-0">
                        <a href="{{ @$backroute ? @$backroute : route("$route.index") }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left"></i> {{ __('message.back') }}
                        </a>
                    </div>
                </div>
                <div class="card-body pt-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-12">
                            {{ html()->form('POST', route($route . '.store'))->class('form form-horizontal')->id('form')->attribute('enctype', 'multipart/form-data')->open() }}
                            @include($route . '.form')
                            <div class="row">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy"></i>
                                        {{ __('message.save') }}</button>
                                </div>
                            </div>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
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
