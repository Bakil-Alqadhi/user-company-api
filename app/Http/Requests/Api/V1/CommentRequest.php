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
}
