<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PopulasiTernakRequest extends FormRequest
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
        $currentYear = now()->year;

        $rules = [
            'jenis_ternak_populasi_id' => 'required|exists:jenis_ternak_populasi,id',
            'id_kecamatan'             => 'required|exists:mst_kecamatan,id',
            'tahun'                    => "required|integer|between:2020,$currentYear",
            'jumlah'                   => 'required|integer|min:0',
            'rtp'                      => 'nullable|integer|min:0',
        ];

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['id'] = 'required|exists:populasi_ternak,id';
        }

        return $rules;
    }
}
