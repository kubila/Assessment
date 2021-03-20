<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $connection = 'mysql';
    protected $fillable = ['total', 'quantity'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'carts_products')->withPivot('cart_id', 'product_id');
    }

}
