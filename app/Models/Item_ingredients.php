<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item_ingredients extends Model
{
    protected $fillable = [
        'itemname','qty','image', 'description','CID'
    ];

    public function Categorys_ingredients()
    {
        return $this->belongsTo(Categorys_ingredients::class);
    }
    
}
