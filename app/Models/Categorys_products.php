<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorys_products extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function Item_products()
    {
        return $this->hasMany(Item_products::class);
    }
}
