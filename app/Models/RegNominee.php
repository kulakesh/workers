<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegNominee extends Model
{
    use HasFactory;
    protected $table = 'reg_nominee';

    protected $fillable = [
        'worker_id',
        'nominee_name1',
        'nominee_dob1',
        'nominee_relation1',
        'nominee_name2',
        'nominee_dob2',
        'nominee_relation2',
        'del'
    ];
    protected $attributes = [
        'del' => 0
    ];
    public function worker(): BelongsTo
    {
        return $this->belongsTo(Registration::class)->withDefault();
    }
}
