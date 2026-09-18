<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UmkmPengolahanPerikananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_pelaku_usaha' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'id_desa' => 'nullable|exists:mst_desa,id',
            'id_kecamatan' => 'nullable|exists:mst_kecamatan,id',
            'jenis_kegiatan' => 'nullable|string|max:255',
            'produk_utama' => 'nullable|string|max:255',
            'jumlah_produksi_bulan' => 'nullable|integer|min:0',
            'harga_beli_bahan_baku' => 'nullable|integer|min:0',
            'harga_jual_produk' => 'nullable|integer|min:0',
            'wilayah_pemasaran' => 'nullable|string|max:255',
            'legalitas' => 'nullable|string|max:255',
            'kendala' => 'nullable|string|max:255',
            'berkelompok' => 'nullable|boolean',
            'nama_kelompok' => 'nullable|string|max:255',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }
} 