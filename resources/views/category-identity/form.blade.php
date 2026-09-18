<x-form-input name="name" label="Name" autofocus />
<x-form-input type="textarea" name="description" label="Description" />
<x-form-input type="number" name="sequence" label="Sequence" />
@include('base-page.form-file-foto', ['column_name_path' => 'file_foto', 'column_name' => 'file'])
