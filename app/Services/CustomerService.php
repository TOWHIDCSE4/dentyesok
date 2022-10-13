<?php

namespace App\Services;

use App\Models\User;

class CustomerService
{
    public function storeUser($data, $id=null)
    {
        if ($id) {
            $user = User::find($id);
            $user->update($data);
        } else {
            User::create($data);
        }
    }
}