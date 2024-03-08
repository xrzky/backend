<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $attributes = [
        'status' => 'pending'
    ];

    
    public function users(): BelongsTo
    {
       return $this->belongsTo(User::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetails::class);
    }
        
}
