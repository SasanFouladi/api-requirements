<?php

namespace App\Models;

use App\Traits\HasDiscount;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use HasDiscount;

    protected $fillable = [
        "id",
        "sku",
        "name",
        "category",
        "price"
    ];

    /**
     * Get original price of product.
     *
     * @return Attribute
     */
    protected function originalPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => (int) $this->price,
        );
    }

    /**
     * Get final price of product.
     *
     * @return Attribute
     */
    protected function finalPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->original_price - ($this->original_price * ($this->getAllDiscount()/100)),
        );
    }

    /**
     * Get discount percentage of product.
     *
     * @return Attribute
     */
    protected function discountPercentage(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getDiscountPercentage() ,
        );
    }
}
