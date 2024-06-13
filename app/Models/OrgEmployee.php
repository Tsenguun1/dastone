<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrgEmployee extends Model
{
    protected $table = 'ORG_EMPLOYEE';
    protected $primaryKey = 'EMP_ID';
    public $timestamps = false; // Assuming no timestamps are needed

    protected $fillable = [
        'REGISTER', 'FIRSTNAME', 'LASTNAME', 'POS_ID', 'DEP_ID', 'EMAIL', 'PASS', 
        'WORK_DATE', 'STATUS', 'BIRTHDATE', 'HANDPHONE', 'HOMEPHONE', 'WORKPHONE', 
        'FINGERID', 'SEX', 'PICTURE_LINK', 'EDIT_DATE', 'EDIT_EMPID', 'PASS_DATE', 
        'PASS_EXPIRE_TERM', 'PASS_ENDDATE', 'PASS_WRONG', 'LAST_LOGINDATE'
    ];
}
