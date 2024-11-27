<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegFamily extends Model
{
    use HasFactory;
    protected $table = 'reg_family';

    protected $fillable = [
        'worker_id',
        'name',
        'age',
        'relation',
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
