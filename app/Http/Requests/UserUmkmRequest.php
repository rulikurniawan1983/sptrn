<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUmkmRequest extends FormRequest
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
            'name'      => 'required|max:150',
            'no_hp'     => 'required|max:20',
            'email'     => 'required|max:200', // NIB / Email
            'is_active' => 'required',
        ];

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['id'] = 'required';
        }
        if ($this->id == null || $this->password) {
            $rules['password'] = 'nullable|string|min:6';
        }
        if ($this->hasFile('file')) {
            $rules['file'] = 'mimes:jpg,png,jpeg,webp|max:5120';
        }
        if ($this->hasFile('file_nib')) {
            $rules['file_nib'] = 'mimes:pdf,jpg,png,jpeg|max:10240';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'     => 'Nama UMKM wajib diisi.',
            'no_hp.required'    => 'Nomor WhatsApp wajib diisi.',
            'email.required'    => 'NIB / Email wajib diisi.',
            'is_active.required'=> 'Status verifikasi wajib ditentukan.',
            'file_nib.mimes'    => 'Berkas NIB harus berformat PDF, JPG, PNG, atau JPEG.',
            'file_nib.max'      => 'Ukuran Berkas NIB maksimal 10 MB.',
        ];
    }
}

