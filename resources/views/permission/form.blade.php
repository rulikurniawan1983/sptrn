<x-form-input name="name" label="Name Permission" autofocus />
@if (@$item == null)
    {{ html()->hidden('category_permission_id', $category_permission_id) }}
@else
    <x-form-select name="category_permission_id" label="Category Permission" :options="$get_CategoryPermission" placeholder="Pilih" />
@endif
@if (@$item == null)
    <div class="row">
        <label class="col-md-4 col-form-label">Buatkan CRUD</label>
        <div class="col-md-8">
            <div class="d-sm-flex gap-3 mb-2 pt-2">
                <x-form-input-radio name="is_crud" value="1">Ya</x-form-input-radio>
                <x-form-input-radio name="is_crud" value="0">Tidak</x-form-input-radio>
            </div>
            <div class="alert alert-danger">
                Ketika <b>Ya</b> maka akan dibuatkan 5 Permission yaitu lain:
                <ul class="mb-0">
                    <li>[Permission] Show</li>
                    <li>[Permission] Detail</li>
                    <li>[Permission] Add</li>
                    <li>[Permission] Edit</li>
                    <li>[Permission] Delete</li>
                </ul>
            </div>
        </div>
    </div>
@endif
