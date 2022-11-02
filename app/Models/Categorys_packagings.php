<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorys_packagings extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function Item_packaging()
    {
        return $this->hasMany(Item_packaging::class);
    }
}
