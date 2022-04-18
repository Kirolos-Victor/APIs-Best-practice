<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class EditTaskRequest extends FormRequest
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
            'title'=>['required'],
            'description'=>['required'],
            'deadline'=>['required','date'],
            'status'=>['nullable','in:0,1']
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response= responseJson(422,$validator->errors()->all());
        throw new ValidationException($validator, $response);
    }
}
