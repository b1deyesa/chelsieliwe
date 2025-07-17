<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carrier extends Model
{
    protected $guarded = ['id'];
    
    protected static function booted()
    {
        static::created(function ($carrier) {
            for ($i = 0; $i < 4; $i++) {
                $carrier->carrierCovers()->create(['path' => null]);
            }
        });
    }
    
    public function portfolios(): HasMany
    {
        return $this->hasMany(Portfolio::class);
    }
    
    public function carrierCovers(): HasMany
    {
        return $this->hasMany(CarrierCover::class);
    }
}
