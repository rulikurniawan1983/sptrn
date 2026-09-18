<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RekomendasiNkvRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'nama_pemohon'       => 'required|string|max:255',
            'nama_tempat_usaha'  => 'required|string|max:255',
            'alamat_usaha'       => 'required|string',
            'email'              => 'nullable|email|max:255',
            'no_hp'              => 'nullable|string|max:20',

            // file: opsional, tapi harus valid file jika dikirim
            'nib'                => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_permohonan'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'data_umum'          => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'surat_pernyataan'   => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['id'] = 'required|exists:rekomendasi_nkv,id';
        }

        return $rules;
    }
}
