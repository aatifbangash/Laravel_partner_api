<?php

namespace App\Http\Requests;

use Validator;
use App\Exceptions\CustomException;
use Illuminate\Foundation\Http\FormRequest;

class GetUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'uniqueCode' => "required|regex:/^[a-zA-Z0-9_\-]*$/"
        ];
    }

    public function messages(): array
    {
        return [
            'uniqueCode.required' => 'A uniqueCode is required',
            'uniqueCode.regex' => 'A uniqueCode must be a valid value',
        ];
    }

    // following method execute to validate the params/inputs
    public function validateResolved()
    {

        // get all path params
        $params = $this->route()->parameters();

        // Custom validation:- Validate first arg is about data to be validated, 2nd is the rules to be applied on the data, 3rd are the cusom message upon validation failing.
        $validation = Validator::make(
            [
                'uniqueCode' => $params["uniqueCode"]
            ],
            $this->rules(),
            $this->messages()
        );

        // if validation on data fails
        if ($validation->fails()) {
            // $errorMessage = [];
            // * mean get all the messages along with the fieldName
            // foreach($validation->errors()->get("*") as $fieldName => $message) {
            //     $errorMessage[] = [
            //         400,
            //         $message[0],
            //         $fieldName
            //     ];
            // }
            throw new CustomException(400, "must be valid value", "userId");
        }
    }
}
