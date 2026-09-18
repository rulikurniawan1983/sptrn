<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UmkmProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|integer|min:0',
            'satuan'      => 'required|string|max:100',
            'deskripsi'   => 'nullable|string',
            'file_foto_produk' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        $user = auth()->user();
        if ($user && $user->current_role_id != 101) {
            $rules['user_id'] = 'required|exists:users,id';
        }

        return $rules;
    }
}
