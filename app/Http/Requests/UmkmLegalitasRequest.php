<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UmkmLegalitasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'jenis_legalitas' => 'required|string|max:255',
            'nomor_dokumen' => 'nullable|string|max:255',
            'file_legalitas' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ];
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['id'] = 'required';
        }
        return $rules;
    }
}
