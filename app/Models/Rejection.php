<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rejection extends Model
{
    use HasFactory;
    protected $table = 'rejection';

    protected $fillable = [
        'worker_id',
        'rejected_by',
        'district_id',
        'reason',
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
