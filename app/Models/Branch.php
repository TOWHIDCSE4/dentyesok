<?php

namespace App\Models;

use App\Traits\ModelUuid;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use ModelUuid;

    protected $fillable = [
        'name',
        'address',
        'organization_id'
    ];
}
