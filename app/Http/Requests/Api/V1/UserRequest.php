<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

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
        $method = $this->method();
        if ($method == 'PUT' || $method == 'POST') {
            return [
                'first_name' => 'required|string|min:3|max:40',
                'last_name' => 'required|string|min:3|max:40',
                'phone_number' => 'required|regex:/^\+7\d{10}$/',
                'avatar' => 'required|image|mimes:png,jpg|max:2048',
            ];
        } else if($method == 'PATCH'){
            return [
                'first_name' => 'sometimes|required|string|min:3|max:40',
                'last_name' => 'sometimes|required|string|min:3|max:40',
                'phone_number' => 'sometimes|required|regex:/^\+7\d{10}$/',
                'avatar' => 'sometimes|required|image|mimes:png,jpg|max:2048',
            ];
        }
        
    }
}
