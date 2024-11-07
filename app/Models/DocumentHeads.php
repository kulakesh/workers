<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentHeads extends Model
{
    use HasFactory;
    protected $table = 'document_heads';

    protected $fillable = [
        'name',
        'type',
        'del',
    ];
    public function docs(): HasMany
    {
        return $this->hasMany(Documents::class,'head_id')->whereDel(0);
    }
    protected $attributes = [
        'del' => 0
    ];
}
