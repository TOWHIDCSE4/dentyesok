<?php

namespace App\Services;

use App\Models\Branch;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationService
{
    public function register(Request $request)
    {
        $org = $request->only('name', 'address', 'type', 'size', 'number_branch', 'stared_at', 'settlement_month');

        $newOrg = Organization::create($org);

        $customer = [
            'name' => $request->user_name,
            'email' => $request->email,
            'organization_id' => $newOrg->id,
            'password' => bcrypt($request->password),
            'role' => User::ROLE_OWNER
        ];

        $user = User::create($customer);

        if ($org['type'] == Organization::TYPE_PERSONAL) {
            $branch = [
                'name' => $org['name'],
                'address' => $org['address'],
                'organization_id' => $newOrg->id
            ];
            Branch::create($branch);
        }

        event(new Registered($user));
    }

    public function findById($id)
    {
        return Organization::find($id);
    }

    public function updateProfile($data)
    {
        $com_id = Auth::user()->organization_id;
        Organization::where('id', $com_id)->update($data);
    }
}