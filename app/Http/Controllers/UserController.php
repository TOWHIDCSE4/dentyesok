<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $customerService;
    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function getProfile()
    {
        $user = Auth::user();
        return $this->dataResponse($user);
    }

    public function updateProfile(UpdateUserProfileRequest $request)
    {
        $user = $request->only('name', 'email');
        try {
            $this->customerService->storeUser($user, Auth::id());
            return $this->successResponse(__("Update profile successfully."));
        } catch (\Exception $e) {
            report($e);
            return $this->errorResponse(__("Update profile failed."));
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return $this->errorResponse(__("Current password is wrong."));
        }
        try {
            $this->customerService->storeUser(['password' => bcrypt($request->password)], $user->id);
            return $this->successResponse(__("Update password successfully."));
        } catch (\Exception $e) {
            report($e);
            return $this->errorResponse(__("Update password failed."));
        }
    }
}