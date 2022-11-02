<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Storages extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function Import_ingredients_items()
    {
        return $this->hasMany(Import_ingredients_items::class);
    }

    public function Import_product_items()
    {
        return $this->hasMany(Import_product_items::class);
    }

}
