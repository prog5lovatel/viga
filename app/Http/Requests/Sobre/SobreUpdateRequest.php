<?php

namespace App\Http\Requests\Sobre;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SobreUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'missao' =>    ['required'],
            'visao' =>    ['required'],
            'texto' =>   ['required'],
            'valores' =>   ['required']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->first();

        throw new HttpResponseException(response()->json(['erro' => $error], 422));
    }
}
