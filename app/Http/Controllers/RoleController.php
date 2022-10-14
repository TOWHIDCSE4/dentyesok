<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Services\RoleService;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    use ApiResponse;

    protected $roleService;
    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function roleList()
    {
        $roles = $this->roleService->roleList();
        return response()->json(['roles' => $roles],200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleService->allData()->paginate(10);
        return $this->dataResponse($roles, 'Role list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {
        $data = $request->only('name');
        $data['uuid'] = Str::uuid();
        try {
            $this->roleService->createRole($data);
            return $this->successResponse(__("Create role successfully."));
        } catch (\Exception $e) {
            report($e);
            return $this->errorResponse(__("Create role failed."));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->roleService->findById($id);
        return $this->dataResponse($role, 'Role Details');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        //
        $data = $request->only('name');
        try {
            $this->roleService->updateRole($data,$id);
            return $this->successResponse(__("Update role successfully."));
        } catch (\Exception $e) {
            report($e);
            return $this->errorResponse(__("Update role failed."));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $role = $this->roleService->findById($id);
            $role->delete();
            return $this->successResponse(__("Delete role successfully."));
        } catch (\Exception $e) {
            report($e);
            return $this->errorResponse(__("Delete role failed."));
        }
    }
}
