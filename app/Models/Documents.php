<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documents extends Model
{
    use HasFactory;
    protected $table = 'documents';

    protected $fillable = [
        'head_id',
        'name',
        'del',
    ];
    public function head(): BelongsTo
    {
        return $this->belongsTo(DocumentHeads::class)->withDefault();
    }
    protected $attributes = [
        'del' => 0
    ];
}
