@if(!in_array(auth()->user()->current_role_id, [101, 102]))
    <x-form-select name="user_id" label="Pelaku UMKM" placeholder="Pilih Pelaku UMKM" :options="$listUmkm ?? []" required />
@endif
<x-form-input name="nama_produk" label="Nama Produk" autofocus required />
<div class="row mb-3">
    <label class="col-md-4 col-form-label">Deskripsi</label>
    <div class="col-md-8">
        {{ html()->textarea('deskripsi')->class('form-control')->placeholder('Masukkan deskripsi...') }}
    </div>
</div>
<x-form-input name="harga" type="number" label="Harga (Rp)" required />
<x-form-input name="satuan" label="Satuan (misal: 1 Pcs, 25kg, 1000 ekor)" required />
<div class="row mb-3">
    <label class="col-md-4 col-form-label">Foto Produk (Opsional)</label>
    <div class="col-md-8">
        <input type="file" class="form-control" name="file_foto_produk" accept="image/*">
        @if(isset($item) && $item->foto_produk)
            <div class="mt-2">
                <img src="{{ $item->foto_produk_url }}" width="150" class="img-thumbnail rounded">
            </div>
        @endif
    </div>
</div>
@if(!in_array(auth()->user()->current_role_id, [101, 102]))
    <x-form-select name="is_active" label="Status Publikasi" :options="[1 => 'Aktif / Tayang di Portal Publik', 0 => 'Menunggu Verifikasi (Draft)']" :value="isset($item) ? $item->is_active : 1" required />
@endif

