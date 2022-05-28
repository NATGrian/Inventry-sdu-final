<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Relevant_groups extends Model
{
    protected $fillable = [
        'role' ,'description' ,
    ];
    public $timestamps = false;

    public function Relevants()
    {
        return $this->hasMany(Relevants::class);
    }
}
