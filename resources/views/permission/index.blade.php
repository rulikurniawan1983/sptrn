@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    @can("$permission_main Add")
        <div class="mb-3">
            <a href="{{ route('category-permission.create') }}" class="btn btn-primary">
                <i class="ti ti-plus"></i> {{ __('message.add') }}
            </a>
        </div>
    @endcan
    <div class="row mb-5">
        @php
            $items = $get_CategoryPermission; // Contoh pengambilan data dari model Item
            $chunkedItems = $items->chunk(ceil(count($items) / 4)); // Membagi data menjadi tiga bagian
            $no = 0;
        @endphp
        @foreach ($chunkedItems as $key => $chunk)
            <div class="col-md-6 col-lg-3">
                @foreach ($chunk as $item)
                    @php
                        $no++;
                    @endphp
                    <div class="card shadow-sm mb-3">
                        <div class="card-header border-bottom d-flex justify-content-between border-1 py-3">
                            <div class="card-title mb-0">
                                <h6 class="mb-0">{{ $no }}. {{ $item->name }}</h6>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="MonthlyCampaign" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="MonthlyCampaign">
                                    @can("$permission_main Add")
                                        <a class="dropdown-item"
                                            href="{{ route("$route.create", ['category_permission_id' => $item->id]) }}">Add
                                            Permission</a>
                                    @endcan
                                    @can("$permission_main Edit")
                                        <a class="dropdown-item"
                                            href="{{ route('category-permission.edit', $item->id) }}">Edit</a>
                                    @endcan
                                    @can("$permission_main Detail")
                                        <a class="dropdown-item"
                                            href="{{ route('category-permission.show', $item->id) }}">Detail</a>
                                    @endcan
                                    @can("$permission_main Delete")
                                        {{ html()->form('DELETE', route('category-permission.destroy', $item->id))->open() }}
                                        <a class="dropdown-item" href="javascript:void(0);"
                                            onclick="SwalDelete($(this).closest('form'))">Delete</a>
                                        {{ html()->form()->close() }}
                                    @endcan
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <ul class="list-group list-group-flush">
                                @foreach ($item->permission as $item_permission)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <span>
                                                <i class="ti ti-lock"></i>{{ $item_permission->name }}
                                            </span>
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="MonthlyCampaign"
                                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="MonthlyCampaign">
                                                    @can("$permission_main Edit")
                                                        <a class="dropdown-item"
                                                            href="{{ route("$route.edit", $item_permission->id) }}">Edit</a>
                                                    @endcan
                                                    @can("$permission_main Detail")
                                                        <a class="dropdown-item"
                                                            href="{{ route("$route.show", $item_permission->id) }}">Detail</a>
                                                    @endcan
                                                    @can("$permission_main Delete")
                                                        {{ html()->form('DELETE', route($route . '.destroy', $item_permission->id))->open() }}
                                                        <a class="dropdown-item" href="javascript:void(0);"
                                                            onclick="SwalDelete($(this).closest('form'))">Delete</a>
                                                        {{ html()->form()->close() }}
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
@push('styles')
@endpush
@push('script')
    <script>
        $(document).ready(function() {});
    </script>
@endpush
