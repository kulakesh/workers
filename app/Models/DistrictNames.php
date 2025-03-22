<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictNames extends Model
{
    use HasFactory;
    protected $table = 'district_names';

    protected $fillable = [
        'short_code',
        'name',
    ];
}
