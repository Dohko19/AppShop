<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules =[
            'name' => 'required|min:2',
            'email' => [
                'required',
                Rule::unique('users')->ignore( $this->route('user')->id )
            ],
            'address' => 'required|min:6',
            'phone' => 'required|min:8',
            'username' => ['min:2',
                Rule::unique('users')->ignore( $this->route('user')->id)]
        ];

        if ($this->filled('password')) {
            $rules['password'] = ['confirmed', 'min:6'];
        }

        return $rules;
    }
}
