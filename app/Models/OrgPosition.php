<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrgPosition extends Model
{
    protected $table = 'ORG_POSITION';

    // Optionally define fillable fields if necessary
    protected $fillable = [
        'pos_name',
        'status',
        'edit_date',
        'edit_empid',
        'sort_order',
    ];

    // Define any relationships or additional methods here
}
