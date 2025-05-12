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
        'marital',
        'spouse',
        'gender',
        'dob',
        'cast',
        'tribe',
        'email',
        'phone',
        'bg',
        'city_t',
        'district_t',
        'district_t_code',
        'state_t',
        'state_t_code',
        'pin_t',
        'po_t',
        'ps_t',
        'address_t',
        'city_p',
        'district_p',
        'district_p_code',
        'state_p',
        'state_p_code',
        'pin_p',
        'po_p',
        'ps_p',
        'address_p',
        'aadhaar',
        'nature',
        'serial',
        'doe',
        'dor',
        'turnover',
        'total_years',
        'est_name',
        'est_reg_no',
        'est_address',
        'employer_name',
        'employer_address',
        'other_welfare',
        'welfare_name',
        'welfare_reg_no',
        'more_bocw',
        'number_of_bocw',
        'primary_bocw',
        'nominee',
        'relation',
        'approval',
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
    public function payment(): HasMany
    {
        return $this->hasMany(Renewals::class, 'worker_id')->whereDel(0)->orderBy('id', 'DESC');
    }
    protected $attributes = [
        'approval' => 0,
        'del' => 0
    ];
}
