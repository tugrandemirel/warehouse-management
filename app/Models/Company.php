<?php

namespace App\Models;

use App\Enum\Company\CompanyIsActiveEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Company extends Model implements HasMedia
{
    use HasFactory,  InteractsWithMedia;

    protected $fillable = [
        "user_id",
        "country_id",
        "state_id",
        "name",
        "degree",
        "tax_administration",
        "tax_number",
        "room_registration_number",
        "description",
        "phone",
        "email",
        "website",
        "address",
        "post_code",
        "logo",
        'is_active'
    ];

    protected $casts = [
        'is_active' => CompanyIsActiveEnum::class
    ];

    protected $appends = [
        'logo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function getLogoAttribute()
    {
        return !empty($this->getFirstMediaUrl('company')) ?  $this->getFirstMediaUrl('company') : asset('images/no-image.png');
    }
}
