<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrgPosition extends Model
{
    protected $table = 'ORG_POSITION';
    protected $primaryKey = 'POS_ID'; // Specify the primary key

    public $timestamps = false; // Disable timestamps if not using them

    protected $fillable = [
        'POS_NAME', 'STATUS', 'SORT_ORDER', 'EDIT_DATE', 'EDIT_EMPID'
    ];
}
