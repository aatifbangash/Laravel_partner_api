<?php

namespace App\Http\Controllers;

use App\Http\Services\MemberService;
use App\Http\Requests\GetUserRequest;
use App\Http\Requests\UpdateUserRequest;

class Members
{

    // MemberService will auto inject the Service class.
    public function __construct(
        protected MemberService $memberService
    ) {
    }

    // GetUserRequest is called the Custom formRequest
    public function getUser(GetUserRequest $request, $uniqueCode)
    {
        return $this->memberService->getUser($uniqueCode);
    }

    public function updateUser(UpdateUserRequest $request, $uniqueCode){

        return $this->memberService->updateUser($request->all(), $uniqueCode);
        
    }
}
