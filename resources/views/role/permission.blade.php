@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="mb-3">
        <a href="{{ route("$route.index") }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </div>
    {{ html()->form('POST', route($route . '.set-permission-action'))->class('form form-horizontal')->attribute('enctype', 'multipart/form-data')->open() }}
    {{ html()->hidden('id', $item->id) }}
    <div class="alert alert-danger text-center fs-5">
        <strong>Name: </strong> {{ $item->name }}
    </div>
    <div class="text-center mb-3">
        <button class="btn btn-success"><i class="ti ti-device-floppy"></i> Simpan</button>
    </div>
    <div class="row mb-5">
        @php
            $items = $get_CategoryPermission; // Contoh pengambilan data dari model Item
            $chunkedItems = $items->chunk(ceil(count($items) / 4)); // Membagi data menjadi tiga bagian
        @endphp
        @foreach ($chunkedItems as $chunk)
            <div class="col-md-6 col-lg-3">
                @foreach ($chunk as $value)
                    <div class="card shadow-sm mb-3">
                        <div class="card-header border-bottom d-flex justify-content-between border-1 py-3">
                            <div class="card-title mb-0">
                                <h6 class="mb-0">{{ $value->name }}</h6>
                            </div>
                            <div>
                                <input type="checkbox" class="check-all">
                            </div>
                        </div>
                        <div class="">
                            <ul class="list-group list-group-flush">
                                @foreach ($value->permission as $item_permission)
                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-between">
                                            <div class="checkbox">
                                                <label class="cursor-pointer">
                                                    <x-form-input-checkbox name="permission_id[]" :value="$item_permission->id"
                                                        :checked="$item->hasPermissionTo($item_permission->name)">{{ $item_permission->name }}</x-form-input-checkbox>
                                                </label>
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
    {{ html()->form()->close() }}
@endsection
@push('styles')
    <style>
        input[type=checkbox] {
            transform: scale(1.2);
            -webkit-transform: scale(1.2);
            -moz-transform: scale(1.2);
            -ms-transform: scale(1.2);
            -o-transform: scale(1.2);
        }
    </style>
@endpush
@push('script')
    <script>
        var table;
        $(document).ready(function() {

            $(".check-all").on("change", function() {
                // Temukan kotak centang di card yang terkait
                var checkboxes = $(this).closest(".card").find("input[name='permission_id[]']");
                checkboxes.prop("checked", this.checked);
            });


            // Saat salah satu kotak centang di card di klik
            $("input[name='permission_id[]']").on("change", function() {
                // Temukan kotak centang dalam card yang terkait
                var checkboxes = $(this).closest(".card").find("input[name='permission_id[]']");
                // Periksa apakah semua kotak centang dalam card tersebut telah dicentang
                var allChecked = checkboxes.filter(":checked").length === checkboxes.length;
                // Perbarui kotak centang "Check All" sesuai dengan kondisi kotak centang dalam card
                $(this).closest(".card").find(".check-all").prop("checked", allChecked);
            });

            table = $('#DataTable').DataTable({
                "ordering": false,
                'searching': true,
                "paging": false,
            });
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
