<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UserRequest extends FormRequest
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

        $phoneRule = [
            'phone_number' => [
                'required',
                'regex:/^\+7\d{10}$/',
            ],
        ];
        $method = $this->method();
        if ($method == 'PUT' || $method == 'POST') {
            $phoneRule['phone_number'][] = Rule::unique('users');
            return [
                'first_name' => 'required|string|min:3|max:40',
                'last_name' => 'required|string|min:3|max:40',
                'avatar' => 'required|image|mimes:png,jpg|max:2048',
            ] + $phoneRule;
        } else if($method == 'PATCH'){
            $phoneRule['phone_number'][] = Rule::unique('users')->ignore($this->route('user'));
            $phoneRule['phone_number'][] = 'sometimes';

            return [
                'first_name' => 'sometimes|required|string|min:3|max:40',
                'last_name' => 'sometimes|required|string|min:3|max:40',
                // 'phone_number' => 'sometimes|required|regex:/^\+7\d{10}$/',
                'avatar' => 'sometimes|required|image|mimes:png,jpg|max:2048',
            ] + $phoneRule;
        }
        
    }


    public function messages()
    {
        return [
            'first_name.required' => 'Please enter a name.',
            'first_name.min' => 'First Name must be at least 3 characters.',
            'first_name.max' => 'Name cannot be more than 40 characters.',
            'last_name.required' => 'Please enter a last name.',
            'last_name.min' => 'Last name must be at least 3 characters.',
            'last_name.max' => 'Last name cannot be more than 40 characters.',
            'phone_number.regex' => 'Please enter a valid phone number in the format +7XXXXXXXXXX.',
            'avatar.required' => 'Please upload an avatar image.',
            'avatar.image' => 'Avatar must be an image.',
            'avatar.mimes' => 'Avatar must be in PNG or JPG format.',
            'avatar.max' => 'Avatar size cannot exceed 2 MB.',
        ];
    }
}
