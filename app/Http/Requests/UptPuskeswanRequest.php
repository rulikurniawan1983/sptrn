<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UptPuskeswanRequest extends FormRequest
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
        ];
        if ($this->section == "form") {
            $rules += [
                'nama'                => 'required',
                'id_kecamatan'        => '',
                'id_kelurahan'        => '',
            ];
        }
        if ($this->section == "form-kontak-alamat") {
            $rules += [
                'alamat'   => '',
                'kode_pos' => '',
                'no_tlp_1' => '',
                'no_tlp_2' => '',
                'fax'      => '',
                'email'    => '',
                'website'  => '',
            ];
        }
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['id'] = 'required';
        }
        return $rules;
    }
}
