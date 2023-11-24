<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            return  [
                'name' => 'required|string|min:3|max:40',
                'description' => 'required|string|between:150,400',
                'logo' => 'required|image|mimes:png|max:3072', // Max size is 3 MB (3072 KB)
            ];

        } else if($method == 'PATCH') {
            return  [
                'name' => 'sometimes|required|string|min:3|max:40',
                'description' => 'sometimes|required|string|between:150,400',
                'logo' => 'sometimes|required|image|mimes:png|max:3072', // Max size is 3 MB (3072 KB)
            ];
        }    
    }
    public function messages()
    {
        return [
            'name.required' => 'Please enter a name.',
            'name.min' => 'Name must be at least 3 characters.',
            'name.max' => 'Name cannot be more than 40 characters.',
            'description.required' => 'Please enter a description.',
            'description.between' => 'Description must be between 150 and 400 characters.',
            'logo.required' => 'Please upload a company logo.',
            'logo.image' => 'Logo must be an image.',
            'logo.mimes' => 'Logo must be in PNG format.',
            'logo.max' => 'Logo size cannot exceed more than 3 MB.',
        ];
    }
}
