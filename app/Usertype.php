<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usertype extends Model
{
    protected $fillable = [
        'role', 'permission' ,'description' ,
    ];
    public $timestamps = false;

    public function Users()
    {
        return $this->hasMany(User::class);
    }
}
