<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Culture extends Model
{
    use HasFactory;

    protected $table = "nl_culture";

    protected function getCultureAttribute($value) {
        return Str::of($value)->upper()->explode("-")->last();
    }
}
