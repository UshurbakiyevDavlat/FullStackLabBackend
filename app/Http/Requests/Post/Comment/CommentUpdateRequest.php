<?php

namespace App\Http\Requests\Post\Comment;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CommentUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'body' => 'string|min:1|max:1000'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        //write your business logic here otherwise it will give same old JSON response
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
