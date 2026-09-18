@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <x-tab-upt-puskeswan-component :item="$getParent" :active-tab="$titlePage" :is-lock="false" />

    <div class="card shadow-sm mb-3">
        <div class="card-header border-bottom py-3 d-md-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">{{ $titlePage }}</h5>
            <div class="mt-2 mt-md-0 d-flex flex-column flex-sm-row gap-2">
                @if (!@$disabled_add)
                    @can("$permission_main Add")
                        <a href="{{ @$routeAddCustom ? @$routeAddCustom : route("$route.create", ['id_upt_puskeswan' => $getParent->id]) }}" class="btn btn-primary">
                            <i class="ti ti-plus"></i> {{ __('message.add') }}
                        </a>
                        <a href="{{ route("$route.create-multiple", ["id_upt_puskeswan" => $getParent->id]) }}" class="btn btn-info">
                            <i class="ti ti-plus"></i> Tambah Kolektif
                        </a>
                    @endcan
                @endif
            </div>
        </div>
    </div>

    <div class="row" data-masonry='{"percentPosition": true }'>
        @foreach ($data as $item)
            <div class="col-6 col-sm-4 col-lg-3 col-xl-2 mb-4">
                <div class="card shadow-sm">
                    <a data-fslightbox="gallery" href="{{$item->file_foto}}">
                        <img class="card-img-top" src="{{$item->file_foto}}" alt="Card image cap" />
                    </a>
                    <div class="card-body p-2">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-column">
                                <span class="badge bg-label-primary" style="top:10px; position: absolute;">{{$item->jenis_galeri->nama}}</span>
                                <span class="card-title mb-0" style="font-size: 10pt;">{{$item->nama}}</span>
                                <p class="card-text"><small class="text-muted"  style="font-size: 8pt;">{{$item->created_at_diff}}</small></p>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="MonthlyCampaign" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="MonthlyCampaign">
                                    @can("$permission_main Edit")
                                        <a class="dropdown-item" href="{{route("$route.edit", $item->id)}}">Edit</a>
                                    @endcan
                                    @can("$permission_main Delete")
                                        {{ html()->form('DELETE', route($route . '.destroy', $item->id))->open() }}
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="SwalDelete($(this).closest('form'))">Delete</a>
                                        {{ html()->form()->close() }}
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4 col-md-12 text-center">
        {{ $data->links() }}
    </div>

    <p class="font-400 font-15 text-center">
        Showing <b>{{ $data->firstItem() }}</b> to <b>{{ $data->lastItem() }}</b> of total <b>{{$data->total()}}</b>
    </p>
@endsection
@push('styles')
@endpush
@push('script')
    <script src="{{ asset('/') }}assets/vendor/libs/masonry/masonry.js"></script>
    <script src="{{ asset('/') }}assets/vendor/libs/fslightbox/index.js"></script>
    <script>
        var table;
        $(document).ready(function() {
            $("#CheckAll").click(function() {
                $('#DataTable').find('.CheckboxRow').not(this).prop('checked', this.checked);
                CheckTotalCheckedData();
            });
        });

        function CheckTotalCheckedData() {
            CheckTotalChecked(['#DeleteSelected']);
        }
    </script>
@endpush

