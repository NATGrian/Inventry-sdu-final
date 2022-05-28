<?php

namespace App\Models;
use app\User;
use Illuminate\Database\Eloquent\Model;

class Import_product_items extends Model
{
    protected $fillable = [
        'idproduct',
        'UID', 
        'PID',
        'Batch_no',
        'import_at',
        'MFG',
        'EXP',
        'qty_charge',
        'qty',
        'description',
        'storageID',
    ];

    public function Users()
    {
        return $this->belongsTo(User::class);
    }

    public function Relevants()
    {
        return $this->belongsTo(Relevants::class);
    }

    public function Storages()
    {
        return $this->belongsTo(Storages::class);
    }

    public function Item_products()
    {
        return $this->belongsTo(Item_products::class);
    }
}
