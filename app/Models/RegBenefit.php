<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegBenefit extends Model
{
    use HasFactory;
    protected $table = 'reg_benefits';

    protected $fillable = [
        'worker_id',
        'name',
        'dob',
        'amount',
        'cheque',
        'bank',
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
