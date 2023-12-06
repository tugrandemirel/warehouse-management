<?php

namespace App\Models;

use App\Enum\Settings\Product\Currency\CurrencyIsDefaultEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'parent_id',
        'phone',
        'address',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the parent user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    /**
     * Get all of the children for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    /**
     * Get all of the warehouses for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function warehouses(): HasMany
    {
        return $this->hasMany(Warehouse::class);
    }

    /**
     * Get all of the warehouseShelves for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function warehouseShelves(): HasMany
    {
        return $this->hasMany(WarehouseShelf::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function api(): HasMany
    {
        return $this->hasMany(Api::class);
    }

    public function warehouseShelfGroups(): HasMany
    {
        return $this->hasMany(WarehouseShelfGroup::class);
    }

    public function stores(): HasMany
    {
        return $this->hasMany(Store::class);
    }

    public function currencies(): HasMany
    {
        return $this->hasMany(Currency::class);
    }

    public function numbers(): HasMany
    {
        return $this->hasMany(Number::class);
    }

    public function mainConfig(): HasOne
    {
        return $this->HasOne(MainConfig::class);
    }

    public function measurementUnits(): HasMany
    {
        return $this->hasMany(MeasurementUnit::class);
    }

    public function getDefaultCurrency()
    {
        return Cache::remember('currency_' . $this->id, 60 * 60 * 24, function () {
            return Currency::where('user_id', $this->id)
                ->where('is_default', CurrencyIsDefaultEnum::TRUE)
                ->select('symbol')
                ->first();
        });
    }

    public function getMainConfig()
    {
        return Cache::remember('stock_code_' . $this->id, 60 * 60 * 24, function () {
            return MainConfig::where('user_id', $this->id)
                ->select('stock_prefix')
                ->first();
        });
    }

}
