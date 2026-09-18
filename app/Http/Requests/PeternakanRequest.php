<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeternakanRequest extends FormRequest
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
                'id_kbli'             => '',
                'id_jenis_usaha'      => '',
                'id_jenis_peternakan' => '',
                'id_kecamatan'        => '',
                'id_kelurahan'        => '',
            ];
        }
        if ($this->section == "legalitas") {
            $rules += [
                'no_badan_hukum'            => '',
                'tanggal_badan_hukum'       => '',
                'id_pengesahan_badan_hukum' => '',
                'tahun_ind_usaha'           => '',
                'nama_notaris'              => '',
                'npwp'                      => '',
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
        if ($this->section == "form-lainnya") {
            $rules += [
                'id_tingkat_resiko' => '',
                'id_skala_usaha'    => '',
            ];
        }
        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['id'] = 'required';
        }
        return $rules;
    }
}
