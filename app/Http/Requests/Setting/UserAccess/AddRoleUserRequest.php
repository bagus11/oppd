<?php

namespace App\Http\Requests\Setting\UserAccess;

use Illuminate\Foundation\Http\FormRequest;

class AddRoleUserRequest extends FormRequest
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
        return [
            'role'=>'required',
            'user'=>['required','unique:model_has_roles,model_id'],
        ];
    }
}