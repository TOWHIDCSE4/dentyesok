<?php

namespace App\Services;

use App\Models\Employee;

class EmployeeService
{

    public function allData(){
        return Employee::query()->latest();
    }

    public function createEmployee($data){
        return Employee::create($data);
    }


    public function updateEmployee($data,$id){
        return Employee::findOrFail($id)->update($data);
    }

    public function findById($id){
        return Employee::findOrFail($id);
    }
}