<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrgDepartment extends Model
{
    protected $table = 'ORG_DEPARTMENT';
    protected $primaryKey = 'DEP_ID'; // Specify the primary key

    public $timestamps = false; // Disable timestamps if not using them

    protected $fillable = [
        'dep_name', 'status', 'sort_order', 'parent_depid', 'director_empid', 'approve_empid', 'edit_empid', 'edit_date'
    ];
}

