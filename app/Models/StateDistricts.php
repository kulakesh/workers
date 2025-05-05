<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateDistricts extends Model
{
    use HasFactory;
    protected $table = 'state_district';

    protected $fillable = [
        'state_code',
        'state_name',
        'district_code',
        'district_name',
    ];
}
