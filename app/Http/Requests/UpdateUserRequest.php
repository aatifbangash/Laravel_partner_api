<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateUserRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            "uniqueCode" => "regex:/^[a-zA-Z0-9_\-]*$/",
            "firstName" => "required",
            "lastName" => "required",
            "gender" => "required",
            "address.street" => "required",
            "address.houseNumber" => "numeric|integer"
        ];
    }

    /**
     * Data to be validated (requestBody and pathParam and queryParam)
     */
    public function validationData()
    {
        // this->all() = requestBody, this->route('pathParam') = get pathParam
        return array_merge($this->all(), ['uniqueCode' => $this->route('uniqueCode')]);
    }

    /**
     * execute if validation fails 
     * */ 
    protected function failedValidation(Validator $validator)
    {
        $jsonResponse = response()->json(['errors' => $validator->errors()], 422);
        throw new HttpResponseException($jsonResponse);
    }

    /**
     * used to run custom Validation. Note by enabling this method all above methods will stop working
     */
    // public function validateResolved()
    // {
    //    // Validator::make();
    // }
}
