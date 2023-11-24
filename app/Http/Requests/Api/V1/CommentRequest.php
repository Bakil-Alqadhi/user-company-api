<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
                'user_id' => 'required|exists:users,id',
                'company_id' => 'required|exists:companies,id',
                'content' => 'required|string|min:150|max:550',
                'rating' => 'required|integer|between:1,10',
            ];
        } else if($method == 'PATCH'){
            return [
                'user_id' => 'sometimes|required|exists:users,id',
                'company_id' => 'sometimes|required|exists:companies,id',
                'content' => 'sometimes|required|string|min:150|max:550',
                'rating' => 'sometimes|required|integer|between:1,10',
            ];
        }
    }

    public function messages()
    {
        return [
            'user_id.required' => 'User ID is required.',
            'user_id.exists' => 'Invalid user ID. Please provide a valid user ID.',
            'company_id.required' => 'Company ID is required.',
            'company_id.exists' => 'Invalid company ID. Please provide a valid company ID.',
            'content.required' => 'Please enter a comment.',
            'content.between' => 'Comment must be between 150 and 550 characters.',
            'rating.required' => 'Please provide a rating.',
            'rating.integer' => 'Rating must be an integer.',
            'rating.between' => 'Rating must be between 1 and 10.',
        ];
    }
}
