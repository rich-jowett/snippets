<?php

/**
 * SnippetWrite.php
 *
 * @author Rich Jowett <rich@jowett.me>
 */
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class SnippetWrite
 *
 * @author Rich Jowett <rich@jowett.me>
 * @package App\Http\Requests
 */
class SnippetWrite extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code' => 'required',
        ];
    }

    /**
     * What should happen on failed validation
     *
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
