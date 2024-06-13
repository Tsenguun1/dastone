<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrgEmployee extends Model
{
    protected $table = 'ORG_EMPLOYEE';
    // Define fillable fields if necessary
    protected $fillable = [
        'register',
        'firstname',
        'lastname',
        'pos_id',
        'dep_id',
        'email',
        'pass',
        'work_date',
        'status',
        'birthdate',
        'handphone',
        'homephone',
        'workphone',
        'fingerid',
        'sex',
        'picture_link',
        'edit_date',
        'edit_empid',
        'pass_date',
        'pass_expire_term',
        'pass_enddate',
        'pass_wrong',
        'last_logindate',
    ];

    // Define any relationships or additional methods here
}
