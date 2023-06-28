<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return 
        [
            'name' => 
            [
                'required',
                'max:32',
            ],
            'email' => 
            [
                'email',
                'required',
                'max:255',
                'unique:users,email', // uniqueを使用。対象はusersテーブル、emailカラム
            ],
            'password' => 
            [
                'required',
            ],
            'department_id' =>
            [
                'required',
            ],
        ];
    }
}
