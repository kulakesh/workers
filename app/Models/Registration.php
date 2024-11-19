<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Registration extends Authenticatable
{
    use HasFactory;

    protected $table = 'registration';

    protected $fillable = [
        'system_id',
        'operator_id',
        'name',
        'father',
        'mother',
        'spouse',
        'gender',
        'dob',
        'cast',
        'tribe',
        'email',
        'phone',
        'city_t',
        'district_t',
        'state_t',
        'pin_t',
        'address_t',
        'city_p',
        'district_p',
        'state_p',
        'pin_p',
        'address_p',
        'nature',
        'serial',
        'doe',
        'dor',
        'turnover',
        'nominee',
        'relation',
        'del'
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(Operator::class)->withDefault();
    }
    public function employer(): HasMany
    {
        return $this->hasMany(RegEmployer::class, 'worker_id');
    }
    public function photo(): HasMany
    {
        return $this->hasMany(RegPhoto::class, 'worker_id')->orderBy('id', 'DESC');
    }
    public function family(): HasMany
    {
        return $this->hasMany(RegBiomatric::class, 'worker_id')->orderBy('id', 'DESC');
    }
    public function document(): HasMany
    {
        return $this->hasMany(RegDocument::class, 'worker_id');
    }
    protected $attributes = [
        'del' => 0
    ];
}
