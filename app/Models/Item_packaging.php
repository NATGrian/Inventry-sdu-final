<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item_packaging extends Model
{
    protected $fillable = [
        'itemname','qty','image', 'description','CID'
    ];

    public function Categorys_packagings()
    {
        return $this->belongsTo(Categorys_packagings::class);
    }
}
