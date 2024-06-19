<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchFee extends Model
{
    protected $table = 'MERCH_FEES';
    protected $primaryKey = 'FEE_ID';
    public $timestamps = false;

    protected $fillable = [
        'FEE_NAME',
        'FEE_DESCR',
        'FEE_TYPE',
        'ORDER_NO',
        'STATUS',
        'UPDATE_DATE',
        'UPDATE_EMPID'
    ];
}
