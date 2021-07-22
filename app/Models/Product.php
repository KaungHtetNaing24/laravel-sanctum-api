<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $table = "products";
    protected $fillable = ['name','description'];

    public function product_models(){
        return $this->hasMany(Product_model::class);
    } 

    public function companies(){
        return $this->hasOne(Company::class);
    }
}
