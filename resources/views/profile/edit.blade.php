@extends('layouts.app')
@section('title', $titlePage . ' Edit Profile')
@section('content')
    <x-profile-user activeTab="Edit Profile">
        @php
            $auth_user = auth()->user();
        @endphp
        <div class="card shadow-sm mb-4">
            <h5 class="card-header">Profile Details</h5>
            {{ html()->modelForm($auth_user)->route($route . '.update')->method('POST')->class('form form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{{ $auth_user->file_url }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded"
                        id="uploadedAvatar" />
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                            <span class="d-none d-sm-block">Upload new photo</span>
                            <i class="ti ti-upload d-block d-sm-none"></i>
                            <div hidden>
                                <x-form-input type="file" name="file" id="upload" class="account-file-input"
                                    accept='image/*' />
                            </div>
                        </label>
                        <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                            <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Reset</span>
                        </button>
                        <div class="text-muted">Allowed JPG, GIF or PNG. Max size of 800K</div>
                    </div>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <x-form-input name="name" label="Name" autofocus :horizontal="false" />
                        <label class="form-label">Nama Lengkap</label>
                    </div>
                    <div class="mb-3 col-md-6">
                        <x-form-input name="nama_pemilik" label="Nama Pemilik" :horizontal="false" />
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <x-form-input name="email" label="e-Mail" :horizontal="false" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label">No. HP</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">ID (+62)</span>
                            <x-form-input name="no_hp" :use-label="false" :horizontal="false" id="phoneNumber" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-8">
                        <x-form-input type="textarea" name="deskripsi" label="Deskripsi" :horizontal="false" />
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                </div>
            </div>
            {{ html()->form()->close() }}
        </div>
    </x-profile-user>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/css/pages/page-profile.css" />
@endpush
@push('script')
    <script>
        $(document).ready(function() {});
        let accountUserImage = document.getElementById('uploadedAvatar');
        const fileInput = document.querySelector('.account-file-input'),
            resetFileInput = document.querySelector('.account-image-reset');

        if (accountUserImage) {
            const resetImage = accountUserImage.src;
            fileInput.onchange = () => {
                if (fileInput.files[0]) {
                    accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                }
            };
            resetFileInput.onclick = () => {
                fileInput.value = '';
                accountUserImage.src = resetImage;
            };
        }

        const phoneNumber = document.querySelector('#phoneNumber');
        // Phone Mask
        if (phoneNumber) {
            new Cleave(phoneNumber, {
                phone: true,
                phoneRegionCode: 'US'
            });
        }
    </script>
@endpush
