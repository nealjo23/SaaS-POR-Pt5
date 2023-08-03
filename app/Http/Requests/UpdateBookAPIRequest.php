<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateBookAPIRequest extends FormRequest
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
            'subtitle' => ['max:256'],
            'year_published' => ['integer'],
            'edition' => ['integer'],
            'isbn_10' => ['max:10'],
            'isbn_13' => ['max:13'],
            'height' => ['integer'],
            'genre' => ['max:256'],
            'sub_genre' => ['max:256'],
            'author' => ['max:256'],
            'publisher' => ['max:256'],
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
