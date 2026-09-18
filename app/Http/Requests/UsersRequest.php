<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name' => 'required|max:100',
            'no_hp' => 'required|max:20',
            'is_active' => 'required',
        ];

        $roles = $this->input('role_id', []);
        if (in_array(101, $roles) || in_array(102, $roles)) {
            $rules['email'] = 'required|max:200';
        } else {
            $rules['email'] = 'required|max:200|email';
        }

        if ($this->isMethod('patch') || $this->isMethod('put')) {
            $rules['id'] = 'required';
        }
        if ($this->id == null || $this->password) {
            $rules['password'] = 'required|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|not_in:password,123456,admin';
        }
        if ($this->hasFile('file')) {
            $rules['file'] = 'mimes:jpg,png,jpeg,webp,ico|max:2048';
        }
        return $rules;
    }
    
    public function messages()
    {
        $messages = [
            // Default messages for other fields if needed
        ];

        // Check if 'id' is null or 'password' is present
        if ($this->id == null || $this->password) {
            $messages['password.required'] = 'The password field is required.';
            $messages['password.min'] = 'The password must be at least 8 characters.';
            $messages['password.regex'] = 'The password must contain at least one lowercase letter, one uppercase letter, and one number.';
        }

        // Add more custom messages for other rules as needed

        return $messages;
    }
}
