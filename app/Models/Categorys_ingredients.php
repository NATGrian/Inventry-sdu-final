<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorys_ingredients extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function Item_ingredients()
    {
        return $this->hasMany(Item_ingredients::class);
    }
}
