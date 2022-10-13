<?php

namespace App\Services;

use App\Models\Role;


class RoleService
{

    public function roleList(){
        return Role::all();
    }

    public function allData(){
        return Role::query()->latest();
    }

    public function createRole($data){
        return Role::create($data);
    }


    public function updateRole($data,$id){
        return Role::findOrFail($id)->update($data);
    }

    public function findById($id){
        return Role::findOrFail($id);
    }


}