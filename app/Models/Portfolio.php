<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Portfolio extends Model
{
    protected $guarded = ['id'];
    
    public function carriers(): BelongsTo
    {
        return $this->belongsTo(Carrier::class, 'carrier_id');
    }
}
