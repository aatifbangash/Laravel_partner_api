<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Member extends Model
{
    use HasFactory;

    // @transient field
    public $cultue = null;

    // default primery key field
    protected $primaryKey = 'userid';

    // map model to table
    protected $table = "nl_user";
    
    // disable created_at and updated_at
    public $timestamps = false;

    // disable the mass assignment
    protected $guarded = [];

    // following will cast fields to given types.
    protected $casts = [
        'house_number' => 'integer',
        'date_created' => 'datetime:Y-m-d',
        'saldo' => 'float'
    ];

    // to set default values for the attributes/fields. Will be used during insersion
    protected $attributes = [
        'status' => 1
    ];

    // following is the accessor. It is used to transform the value of the field when accessing.
    protected function getStatusAttribute($value): String
    {
        $status = match ($this->attributes['status']) {
            1 => "Active",
            0 => 'Pending'
        };

        return $status;
    }

    // following is the mutator. It is used to transform the value of the field befor inserting into db.
    protected function setStatusAttribute($value): void
    {
        $this->attributes['status'] = (Str::lower($value) == 'active') ? 1 : 0;
    }

    // following is the accessor
    protected function getDobAttribute($value): String
    {
        return Carbon::parse($value)->format("Y-m-d H:i:s a");
    }
}
