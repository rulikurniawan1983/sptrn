@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    {{ html()->form('POST', route($route . '.save'))->class('form form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    <div class="card shadow-sm">
        <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">{{ $titlePage }}</h5>
            <div class="mt-2 mt-md-0 d-flex flex-column flex-sm-row gap-2">
                @can("$permission_main Add")
                    <a href="{{ route('category-identity.create') }}" class="btn btn-primary">
                        <i class="ti ti-plus"></i> {{ __('message.add') }} Category
                    </a>
                @endcan
                @can("$permission_main Add")
                    <button type="submit" class="btn btn-success">
                        <i class="ti ti-device-floppy"></i> {{ __('message.save') }}
                    </button>
                @endcan
            </div>
        </div>
    </div>
    @foreach ($data as $item)
        <div class="card shadow-sm mt-3">
            <!-- Notifications -->
            <div class="d-flex justify-content-between align-items-center border-bottom">
                <div>
                    <h5 class="card-header pb-1">{{ $item->name }}</h5>
                    <div class="card-body">
                        <span>{{ $item->description }}</span>
                        <div class="error"></div>
                    </div>
                </div>
                <div class="dropdown px-3">
                    <button class="btn p-0" type="button" id="MonthlyCampaign" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        @can("$permission_main Edit")
                            <a class="dropdown-item"
                                href="{{ route("$route.create", ['category_identity_id' => $item->id]) }}">{{ __('message.add') }}
                                Identity</a>
                        @endcan
                        @can("$permission_main Edit")
                            <a class="dropdown-item" href="{{ route('category-identity.edit', $item->id) }}">Edit</a>
                        @endcan
                        @can("$permission_main Delete")
                            <a class="dropdown-item" href="javascript:void(0);"
                                onclick="setDeleteCategory({{ $item->id }})">Delete</a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        @foreach ($item->identity as $sub_item)
                            {{ html()->hidden('kode[]', $sub_item->kode) }}
                            <div class="mb-4">
                                <div class="d-flex align-items-center justify-content-lg-between gap-2">
                                    <h6 class="mb-1">
                                        {{ $sub_item->name }}
                                        <br>
                                        <small>#{{ $sub_item->kode }}</small>
                                    </h6>
                                    <div class="mb-1">
                                        <a href="{{ route($route . '.edit', $sub_item->id) }}"><i
                                                class="ti ti-edit fs-5 text-primary"></i></a>
                                        <a href="javascript:void(0)" onclick="setDeleteIdentity({{ $sub_item->id }})"><i
                                                class="ti ti-trash fs-5 text-danger"></i></a>
                                    </div>
                                </div>
                                @if ($sub_item->type == $listType['Text'])
                                    <x-form-input :name="$sub_item->kode" :value="$sub_item->value" :horizontal="false" :use-label="false" />
                                @elseif ($sub_item->type == $listType['Textarea'])
                                    <x-form-input type="textarea" :name="$sub_item->kode" :value="$sub_item->value" :horizontal="false"
                                        :use-label="false" />
                                @elseif ($sub_item->type == $listType['File'])
                                    <x-form-input type="file" :name="$sub_item->kode" :horizontal="false" :use-label="false" />
                                    <div class="row mt-3">
                                        @if ($sub_item->type_file != 'pdf')
                                            <div class="col-md-6 mx-auto text-center">
                                                <img src="{{ $sub_item->file_foto }}" class="img-fluid" alt="">
                                            </div>
                                        @else
                                            <div class="col-md-12">
                                                <a href="{{ $sub_item->file_foto }}" target="_blank"
                                                    class="btn btn-sm btn-danger">Lihat File</a>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-5 col-8 mx-auto pt-4">
                        <div class="text-center">
                            <img src="{{ $item->file_foto }}" class="img-fluid img-responsive w-100"
                                alt="{{ $item->name }}" width="202">
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Notifications -->
        </div>
    @endforeach
    {{ html()->form()->close() }}
    {{ html()->form('DELETE', route('category-identity.destroy', 0))->class('form-delete-category') }}
    {{ html()->form('DELETE', route($route . '.destroy', 0))->class('form-delete-identity') }}
@endsection
@push('styles')
@endpush
@push('script')
    <script>
        function CheckTotalCheckedData() {
            CheckTotalChecked(['#DeleteSelected']);
        }

        function setDeleteCategory(id) {
            $('.form-delete-category').attr('action', "{{ route('category-identity.index') }}/" + id);
            setTimeout(() => {
                SwalDelete($('.form-delete-category'));
            }, 0);
        }

        function setDeleteIdentity(id) {
            $('.form-delete-identity').attr('action', "{{ route($route . '.index') }}/" + id);
            setTimeout(() => {
                SwalDelete($('.form-delete-identity'));
            }, 0);
        }
    </script>
@endpush
