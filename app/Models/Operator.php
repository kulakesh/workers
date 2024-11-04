<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Operator extends Authenticatable
{
    use HasFactory;

    protected $table = 'operators';

    protected $fillable = [
        'district_id',
        'name',
        'designation',
        'email',
        'phone',
        'city',
        'state',
        'address',
        'pin',
        'username',
        'password',
        'del',
    ];
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class)->withDefault();
    }
    protected $attributes = [
        'del' => 0
    ];
    
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
