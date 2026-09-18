<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JenisTernakProduksiRequest extends FormRequest
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
            'nama' => 'required',
            'jenis_produksi_id' => 'nullable|exists:jenis_produksi,id',
        ];
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['id'] = 'required|exists:jenis_ternak_produksi,id';
        }
        return $rules;
    }
}
