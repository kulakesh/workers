<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Renewals extends Model
{
    use HasFactory;
    protected $fillable = [
        'worker_id',
        'payment_years',
        'payment_amount',
        'payment_mode',
        'payment_ref_no',
        'payment_date',
        'doc_path',
        'img_path',
        'approval',
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
