@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        @include('base-page.header-show')
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-lg-8">
                    <p class="small text-uppercase text-muted">Details</p>
                    <x-detail-item label="Nama" :value="$item->nama"></x-detail-item>
                </div>
                <div class="col-lg-4">
                    <x-detail-list-action-time :item="$item" />
                </div>
            </div>
        </div>
    </div>
@endsection 