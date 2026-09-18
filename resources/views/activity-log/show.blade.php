@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        @include('base-page.header-show')
        <div class="card-body pt-4">
            <div class="row">
                <div class="col-md-8">
                    <p class="small text-uppercase text-muted">Details</p>
                    <x-detail-item label="Module" :value="$item->description" />
                    <x-detail-item label="Event" :value="$item->event" />
                    <x-detail-item label="Subject Type" :value="$item->subject_type" />
                    <x-detail-item label="Subject Id" :value="$item->subject_id" />
                    <x-detail-item label="Data">
                        <textarea id="json-input" class="d-none">{{ $item->properties }}</textarea>
                        <div class="card col-sm-9 p-2 border shadow-sm rounded">
                            <div id="json-renderer"></div>
                        </div>
                    </x-detail-item>
                </div>
                <div class="col-md-4">
                    <div>
                        <p class="small text-uppercase text-muted">Action Time</p>
                        <ul class="list-unstyled card shadow-none border p-3">
                            <x-detail-item label="Created By" :value="$item->causer->name ?? '-'" :isList="true" />
                            <x-detail-item label="Created At" :value="$item->causer->role->name ?? '-'" :isList="true" />
                            <x-detail-item label="Updated By" :value="$item->updated_by_user->name ?? '-'" :isList="true" />
                            <x-detail-item label="Updated At" :value="$item->created_at" :isList="true" />
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/json-viewer/jquery.json-viewer.css" />
@endpush
@push('script')
    <script src="{{ asset('/') }}assets/vendor/libs/json-viewer/jquery.json-viewer.js"></script>
    <script>
        $(document).ready(function() {
            try {
                var input = eval('(' + $('#json-input').val() + ')');
            } catch (error) {
                return alert("Cannot eval JSON: " + error);
            }
            var options = {};
            $('#json-renderer').jsonViewer(input, options);
        });
    </script>
@endpush
