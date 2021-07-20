<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_model extends Model
{
    use HasFactory;

    protected $table = "product_models";

    protected $fillable = ['name'];

    public function product()
    {
        return $this->belongTo(Product::class);
    }
}
