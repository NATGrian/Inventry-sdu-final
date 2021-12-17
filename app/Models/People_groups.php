<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People_groups extends Model
{
    protected $fillable = [
        'role' ,'description' ,
    ];
    public $timestamps = false;

    public function Peoples()
    {
        return $this->hasMany(Peoples::class);
    }
}
