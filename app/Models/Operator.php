<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Operator extends Authenticatable
{
    use HasFactory;

    protected $table = 'operators';

    protected $fillable = [
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
