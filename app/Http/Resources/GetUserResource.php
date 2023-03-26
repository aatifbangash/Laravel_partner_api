<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "userId" => $this->userid,
            "firstName" => $this->first_name,
            "lastName" => $this->last_name,
            "email" => $this->email,
            "emailRequested" => $this->last_email,
            "gender" => $this->gender,
            "dateOfBirth" => $this->dob,
            "culture" => $this->culture,
            "status" => $this->status,
            "type" => $this->type,
            "dateCreated" => $this->date_created,
            "address" => [
                "street" => $this->street1,
                "houseNumber" => $this->house_number,
                "houseNumberAddition" => $this->suffix,
                "zip" => $this->postcode,
                "city" => $this->city,
                "balance" => $this->saldo
            ]
        ];
    }
}
