<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item_products extends Model
{
    protected $fillable = [
        'itemname','qty','image', 'description','CID'
    ];

    public function Categorys_products()
    {
        return $this->belongsTo(Categorys_products::class);
    }
}
