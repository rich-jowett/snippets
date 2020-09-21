<?php

/**
 * UserUpdate.php
 *
 * @author Rich Jowett <rich@jowett.me>
 */

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class UserUpdate
 *
 * @author Rich Jowett <rich@jowett.me>
 * @package App\Http\Requests
 */
class UserUpdate extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required_without:password',
            'password' => 'required_without:name',
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
