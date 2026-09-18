<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LandmarkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'nama'      => 'required|string|max:255',
            'kategori'  => 'required|string|max:255',
            'latitude'  => 'required',
            'longitude' => 'required',
            'alamat'    => 'nullable|string',
            'keterangan'=> 'nullable|string',
        ];

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['id'] = 'required';
        }

        return $rules;
    }
}
