<?php

namespace App\Models;
use app\User;

use Illuminate\Database\Eloquent\Model;

class Import_ingredients_items extends Model
{
    protected $fillable = [
        'idrm',
        'UID', 
        'PID',
        'rc_no',
        'LOT_no',
        'import_at',
        'MFG',
        'EXP',
        'invoice_no',
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

    public function Item_ingredients()
    {
        return $this->belongsTo(Item_ingredients::class);
    }
}
