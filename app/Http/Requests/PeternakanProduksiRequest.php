<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeternakanProduksiRequest extends FormRequest
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
            'id_peternakan'             => 'required',
            'tanggal_produksi_dari'     => 'required',
            'tanggal_produksi_sampai'   => 'required',
        ];
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['id'] = 'required';
        }
        return $rules;
    }
}
