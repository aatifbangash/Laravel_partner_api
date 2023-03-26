<?php

namespace App\Http\Services;

use App\Models\Member;
use App\Exceptions\CustomException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Resources\GetUserResource;
use App\Models\Culture;

class MemberService extends Controller
{
    public function getUser(String $uniqueCode)
    {
        $user = Member::where("unique_code", "=", $uniqueCode)->first();

        if ($user == null)
            throw new CustomException(404, "not found", "userId");

        $partnerCultureId = Config::get('database.connections.' . Config::get('database.default') . '.cultureid');
        $culture = Culture::where('cultureid', $partnerCultureId)->first();
        if ($culture != null)
            $user->culture = $culture->culture;

        // GetUserResource is the Custom Response called API Resource.
        return new GetUserResource($user);
    }

    public function updateUser(array $data, string $uniqueCode)
    {

        $user = Member::where("unique_code", $uniqueCode)->first();

        if ($user == null)
            throw new CustomException(404, "not found", "userId");

        $user->update([
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'],
            'gender' => $data['gender'],
            'status' => $data['status'],
            'dob' => $data['dateOfBirth'],
            'city' => $data['address']['city'],
            'house_number' => $data['address']['houseNumber']
        ]);

        $user->culture = $data['culture'];
        return new GetUserResource($user);
    }
}
