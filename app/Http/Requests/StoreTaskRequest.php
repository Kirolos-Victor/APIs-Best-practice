<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        return [
            'title'=>'required',
            'description'=>'required',
            'deadline'=>'required|date',
            'user_lists_id' => 'required|numeric|min:1|exists:user_lists,id',
            ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response= responseJson(422,$validator->errors()->all());
        throw new ValidationException($validator, $response);
    }
}
