<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'persetujuan' => 'required',
            'jenis'       => 'required',
        ];
        if ($this->jenis == "UMKM") {
            $rules += [
                'nama_UMKM'     => 'required',
                'nama_pemilik'  => 'required',
                'nik'           => 'required',
                'nib'           => 'required',
                'file_nib'      => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
                'no_hp'         => 'required|numeric|digits_between:9,15',
                'kategori_umkm' => 'required|in:peternakan,perikanan,keduanya',
            ];

            $emailField = 'nib';
            if ($this->jenis == "UMKM" && $this->filled('nib')) {
                $rules[$emailField] = 'required|email|max:120|unique:users,email';
            }

            if ($this->filled('no_hp')) {
                $rules['no_hp'] .= '|unique:users,no_hp';
            }
        } else {
            $rules += [
                'id_koperasi'   => 'required',
                'nama_koperasi' => 'required',
            ];
        }
        return $rules;
    }
    
    public function messages()
    {
        return [
            'file_nib.required' => 'Berkas NIB wajib diunggah.',
            'file_nib.file'     => 'Berkas NIB harus berupa dokumen atau gambar.',
            'file_nib.mimes'    => 'Format berkas NIB harus PDF, JPG, JPEG, atau PNG.',
            'file_nib.max'      => 'Ukuran berkas NIB maksimal 10 MB.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal harus terdiri dari 8 karakter.',
            'password.regex' => 'Password harus mengandung setidaknya satu huruf kecil, satu huruf besar, dan satu angka.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'nib.unique' => 'Alamat email sudah terdaftar. Gunakan alamat email atau nomor NIB lain untuk mendaftar.',
            'no_hp.unique' => 'Nomor WhatsApp sudah terdaftar. Gunakan nomor WhatsApp lain untuk mendaftar.',
        ];
    }
}
