<?php

namespace App\Models;
use app\User;
use Illuminate\Database\Eloquent\Model;

class Export_product_items extends Model
{
    protected $fillable = [
        'idproduct',
        'UID', 
        'PID',
        'export_at',
        'order_no',
        'qty_charge',
        'qty',
        'description',
    ];

    public function Users()
    {
        return $this->belongsTo(User::class);
    }

    public function Relevants()
    {
        return $this->belongsTo(Relevants::class);
    }

    public function Item_products()
    {
        return $this->belongsTo(Item_products::class);
    }
}
