<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreBookAPIRequest extends FormRequest
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
        return [
            'title' => ['max:256'],
            'subtitle' => ['nullable', 'max:256'],
            'year_published' => ['nullable', 'integer'],
            'edition' => ['nullable', 'integer'],
            'isbn_10' => ['nullable', 'max:10'],
            'isbn_13' => ['nullable', 'max:13'],
            'height' => ['nullable', 'integer'],
            'genre' => ['nullable', 'max:256'],
            'sub_genre' => ['nullable', 'max:256'],
            'author' => ['nullable', 'max:256'],
            'publisher' => ['nullable', 'max:256'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ]));
    }
}
