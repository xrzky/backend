<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'price',
        'stock',
        'storage',
        'image',
        'image2',
        'image3',
        'image4',
        'description',
        'isDisplayed'
    ];

    public function carts () : HasMany
    {
        return $this->hasMany(Cart::class);
    }

    public function invoiceDetails() : HasMany 
    {
        return $this->hasMany(InvoiceDetails::class);
    }
}
