<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegBiomatric extends Model
{
    use HasFactory;
    protected $table = 'reg_biomatric';

    protected $fillable = [
        'worker_id',
        'img_path',
        'template',
    ];
    public function worker(): BelongsTo
    {
        return $this->belongsTo(Registration::class)->withDefault();
    }
}
