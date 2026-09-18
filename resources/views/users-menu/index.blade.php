@extends('layouts.app')
@section('title', $titlePage)
@section('content')
    <div class="card shadow-sm">
        @include('base-page.header-index', ['disabled_export' => true])
        <div class="card-datatable">
            <table class="datatables-users table" id="DataTable" style="width: 100%;">
                <thead class="border-top">
                    <tr>
                        <th width="1%">#</th>
                        <th width="1%">
                            <input type="checkbox" id="CheckAll" style="position: relative;left: 0px;opacity: 1;">
                        </th>
                        <th width="1%" class="text-center">Opsi</th>
                        <th width="1%">Icon</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Urutan</th>
                        <th>URL</th>
                        <th>Permission</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 0; ?>
                    @foreach ($listUsersMenu as $key => $item)
                        <?php $no++; ?>
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center"><input type='checkbox' class='CheckboxRow'
                                    onclick='CheckTotalCheckedData()' data-id='{{ $item->id }}'
                                    style='position: relative;left: 0px;opacity: 1;' /></td>
                            <td class="text-center">
                                @include('users-menu.buttons', ['route', $route, 'd' => $item])
                            </td>
                            <td class="text-center">{!! $item->icon !!}</td>
                            <td><strong>{{ $item->nama }}</strong></td>
                            <td>{{ $item->kode }}</td>
                            <td>{{ $item->urutan }}</td>
                            <td>{{ $item->url }}</td>
                            <td>{{ $item->permission->name }}</td>
                        </tr>

                        @foreach ($item->children->sortBy(['urutan', 'asc']) as $vkey => $value)
                            <?php $no++; ?>
                            <tr>
                                <td class="text-center">{{ $no }}</td>
                                <td class="text-center"><input type='checkbox' class='CheckboxRow'
                                        onclick='CheckTotalCheckedData()' data-id='{{ $value->id }}'
                                        style='position: relative;left: 0px;opacity: 1;' /></td>
                                <td class="text-center">
                                    @include('users-menu.buttons', ['route', $route, 'd' => $value])
                                </td>
                                <td class="text-center">{!! $value->icon !!}</td>
                                <td>==={{ $value->nama }}</td>
                                <td>{{ $value->kode }}</td>
                                <td>{{ $value->urutan }}</td>
                                <td>{{ $value->url }}</td>
                                <td>{{ $value->permission->name }}</td>
                            </tr>

                            @foreach ($value->children->sortBy(['urutan', 'asc']) as $vkey_sub => $value_sub)
                                <?php $no++; ?>
                                <tr>
                                    <td class="text-center">{{ $no }}</td>
                                    <td class="text-center">
                                        <input type='checkbox' class='CheckboxRow' onclick='CheckTotalCheckedData()'
                                            data-id='{{ $value_sub->id }}'
                                            style='position: relative;left: 0px;opacity: 1;' />
                                    </td>
                                    <td class="text-center">
                                        @include('users-menu.buttons', [
                                            'route',
                                            $route,
                                            'd' => $value_sub,
                                        ])
                                    </td>
                                    <td class="text-center">{!! $value_sub->icon !!}</td>
                                    <td class="text-muted">======{{ $value_sub->nama }}</td>
                                    <td>{{ $value_sub->kode }}</td>
                                    <td>{{ $value_sub->urutan }}</td>
                                    <td>{{ $value_sub->url }}</td>
                                    <td>{{ $value_sub->permission->name }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('styles')
@endpush
@push('script')
    <script>
        var table;
        $(document).ready(function() {
            table = $('#DataTable').DataTable({
                'ordering': false,
                'searching': false,
                scrollY: '400px',
                scrollX: true,
                paging: false,
            });
            // $("#DataTable_filter").find('.form-control').removeClass('form-control-sm');
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
