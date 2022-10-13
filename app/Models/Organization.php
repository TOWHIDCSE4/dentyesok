<?php

namespace App\Models;

use App\Traits\ModelUuid;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use ModelUuid;

    CONST TYPE_BRANCH = 1;
    CONST TYPE_PERSONAL = 2;

    CONST STATUS_NOT_READY = 0;
    CONST STATUS_FREE_TRIAL = 1;
    CONST STATUS_SUBSCRIBED = 2;

    protected $fillable = [
        'name',
        'address',
        'type',
        'size',
        'number_branch',
        'started_at',
        'settlement_month',
        'expiration_date',
        'status'
    ];
}
