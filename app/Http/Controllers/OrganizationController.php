<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganizationRequest;
use App\Http\Requests\UpdateProfileOrganizationRequest;
use App\Services\OrganizationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{
    protected $organizationService;
    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function register(OrganizationRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->organizationService->register($request);
            DB::commit();
            return $this->successResponse(__('created organization successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return $this->errorResponse(__('create organization failed'));
        }
    }

    public function getProfile()
    {
        $user = Auth::user();
        $com = $this->organizationService->findById($user->organization_id);
        return $this->dataResponse($com);
    }

    public function updateProfile(UpdateProfileOrganizationRequest $request)
    {
        $data = $request->only('name', 'address', 'size', 'number_branch', 'settlement_month', 'started_at');
        try {
            $this->organizationService->updateProfile($data);
            return $this->successResponse(__("Update profile successfully."));
        } catch (\Exception $e) {
            report($e);
            return $this->errorResponse(__("Update profile failed."));
        }
    }
}