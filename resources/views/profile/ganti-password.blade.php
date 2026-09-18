@extends('layouts.app')
@section('title', $titlePage . ' Change Password')
@section('content')
    <x-profile-user activeTab="Change Password">
        <div class="card shadow-sm mb-4">
            <h5 class="card-header">Change Password</h5>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{ html()->form('POST', route($route . '.ganti-password-action'))->class('form form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
                <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle">
                        <label class="form-label" for="current_password">Current Password</label>
                        <div class="input-group input-group-merge">
                            <x-form-input type="password" name="current_password" :use-label="false" :placeholder="'&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;'"
                                autofocus />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6 form-password-toggle">
                        <label class="form-label" for="new_password">New Password</label>
                        <div class="input-group input-group-merge">
                            <x-form-input type="password" name="new_password" :use-label="false" :placeholder="'&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb;.'" />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>

                    <div class="mb-3 col-md-6 form-password-toggle">
                        <label class="form-label" for="new_password_confirmation">Confirm New Password</label>
                        <div class="input-group input-group-merge">
                            <x-form-input type="password" name="new_password_confirmation" :use-label="false"
                                :placeholder="'&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;'" />
                            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <h6>Password Requirements:</h6>
                        <ul class="ps-3 mb-0">
                            <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                            <li class="mb-1">At least one lowercase character</li>
                            <li>At least one number, symbol, or whitespace character</li>
                        </ul>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    </div>
                </div>
                {{ html()->form()->close() }}
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
