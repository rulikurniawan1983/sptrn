@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="row">
        <div class="{{ @$col ? @$col : "col-lg-12" }}">
            <div class="card shadow-sm">
                <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ __('message.add') }} {{ $titlePage }}</h5>
                    <div class="mt-2 mt-md-0">
                        <a href="{{ @$backroute ? @$backroute : route("$route.index", ['id_peternakan' => $getParent->id]) }}" class="btn btn-secondary">
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
                            {{ html()->form('POST', route($route . '.store'))->class('form form-horizontal form-ajax')->id('form')->attribute('enctype', 'multipart/form-data')->open() }}
                            {{ html()->hidden('id_peternakan', $getParent->id) }}

                            <x-form-input name="nama" label="Nama" placeholder="Masukkan Nama" />
                            <x-form-select name="id_jenis_galeri" label="Jenis Galeri" placeholder="Pilih Jenis" :options="$listJenisGaleri"/>

                            <div class="dropzone needsclick mb-3">
                                <div class="dz-message needsclick">
                                    <p class="fs-4 note needsclick pt-3 mb-1">Drag and drop your image here</p>
                                    <p class="text-muted d-block fw-normal mb-2">or</p>
                                    <span class="note needsclick btn bg-label-primary d-inline"
                                        id="btnBrowse">Browseimage</span>
                                </div>
                            </div>

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
    <link rel="stylesheet" href="{{ asset('/') }}assets/vendor/libs/dropzone/dropzone.css" />
@endpush
@push('script')
<script src="{{ asset('/') }}assets/vendor/libs/dropzone-2/dist/dropzone-min.js"></script>
<script>
    Dropzone.autoDiscover = false;
    const previewTemplate = `
    <div class="dz-preview dz-file-preview">
    <div class="dz-details">
      <div class="dz-thumbnail">
        <img data-dz-thumbnail>
        <span class="dz-nopreview">No preview</span>
        <div class="dz-success-mark"></div>
        <div class="dz-error-mark"></div>
        <div class="dz-error-message"><span data-dz-errormessage></span></div>
        <div class="progress">
          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
        </div>
      </div>
      <div class="dz-filename" data-dz-name></div>
      <div class="dz-size" data-dz-size></div>
    </div>
    </div>`;

    var doc_upload = new Dropzone(".dropzone", {
        previewTemplate: previewTemplate,
        url: "{{ route($route.'.store') }}",
        // maxFilesize: 100,
        maxFiles: 18,
        parallelUploads: 10,
        method: "post",
        acceptedFiles: ".jpg,.png,.jpeg,.webp",
        paramName: "file",
        dictInvalidFileType: "Type file ini tidak dizinkan",
        addRemoveLinks: true,
        autoProcessQueue: false,
    });

    doc_upload.on("sending", function(a, b, c) {
        a.token = Math.random();
        c.append("_token", "{{ csrf_token() }}");
        c.append("id_peternakan", $('[name=id_peternakan]').val());
        c.append("id_jenis_galeri", $('[name=id_jenis_galeri]').val());
        c.append("nama", $('[name=nama]').val());
    });

    doc_upload.on("queuecomplete", function(file) {
        window.location.href = "{{ url($route) }}?id_peternakan=" + $("[name=id_peternakan]").val();
    });

    $(document).ready(function() {
        $("#form").submit(function(event) {
            event.preventDefault();
            Loading();
            setTimeout(() => {
                doc_upload.processQueue();
            }, 100);
        });
    });
</script>
@endpush
