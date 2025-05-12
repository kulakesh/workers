<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class District extends Authenticatable
{
    use HasFactory;

    protected $table = 'districts';

    protected $fillable = [
        'name',
        'district_id',
        'ro_code',
        'contact_person',
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
    public function district_code(): BelongsTo
    {
        return $this->belongsTo(StateDistricts::class,'district_id','district_code')->withDefault();
    }
}
