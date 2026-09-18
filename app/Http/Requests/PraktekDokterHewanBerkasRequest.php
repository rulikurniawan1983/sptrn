<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PraktekDokterHewanBerkasRequest extends FormRequest
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
            'id_praktek_dokter_hewan' => 'required',
            'id_berkas_keswan'        => 'required',
            'nama'                    => 'required',
            'tanggal_berkas'          => 'required|date',
        ];
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['id'] = 'required';
        }
        return $rules;
    }
}
