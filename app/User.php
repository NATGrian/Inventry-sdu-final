<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Import_ingredients_items;
use App\Models\import_product_items;
use App\Models\export_ingredients_items;
use App\Models\export_product_items;



class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    
    protected $fillable = [
        'firstname', 'lastname' ,'phone' , 'email', 'password','image','role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token', 'passwordResetCode'
    ];

    public function usertypes() {
        return $this->belongsTo(Usertype::class);
   }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function Import_ingredients_items()
    {
        return $this->hasMany(Import_ingredients_items::class);
    }

    public function Import_product_items()
    {
        return $this->hasMany(import_product_items::class);
    }

    public function export_ingredients_items()
    {
        return $this->hasMany(export_ingredients_items::class);
    }

    public function export_product_items()
    {
        return $this->hasMany(export_product_items::class);
    }
}
