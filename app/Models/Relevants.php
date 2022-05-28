<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relevants extends Model
{
    protected $fillable = [
        'firstname', 'lastname' ,'GID' , 'description',
    ];

    public function Relevant_groups() {
        return $this->belongsTo(Relevant_groups::class);
   }

   public function Import_ingredients_items()
    {
        return $this->hasMany(Import_ingredients_items::class);
    }

    public function Import_product_items()
    {
        return $this->hasMany(Import_product_items::class);
    }

    public function Export_ingredients_items()
    {
        return $this->hasMany(Export_ingredients_items::class);
    }

    public function Export_product_items()
    {
        return $this->hasMany(Export_product_items::class);
    }
}
