<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Services\EmployeeService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;

class EmployeeController extends Controller
{
    use ApiResponse;

    protected $employeeService;
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allData()
    {
        $employees = $this->employeeService->allData()->paginate(10);

        return $this->dataResponse($employees, 'Employee list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeCreateRequest $request)
    {
        $data = $request->only('name', 'role_id');
        $data['organization_id'] = auth()->user()->organization_id;
        try {
           $this->employeeService->createEmployee($data);
            return $this->successResponse(__("Create employee successfully."));
        } catch (\Exception $e) {
            report($e);
            return $this->errorResponse(__("Create employee failed."));
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
        $employee = $this->employeeService->findById($id);
        return $this->dataResponse($employee, 'Employee Details');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, $id)
    {
        $data = $request->only('name', 'role_id');
        try {
            $this->employeeService->updateEmployee($data,$id);
            return $this->successResponse(__("Update employee successfully."));
        } catch (\Exception $e) {
            report($e);
            return $this->errorResponse(__("Update employee failed."));
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
         $employee = $this->employeeService->findById($id);
         $employee->delete();
        return $this->successResponse(__("Delete employee successfully."));
    }
}