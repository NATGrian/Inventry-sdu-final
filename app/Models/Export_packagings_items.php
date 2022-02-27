<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Export_packagings_items extends Model
{
    protected $fillable = [
        'idpack',
        'UID', 
        'PID',
        'rc_no',
        'LOT_no',
        'export_at',
        'invoice_no',
        'qty_charge',
        'qty',
        'description',
        'code_product',
    ];

    public function Users()
    {
        return $this->belongsTo(User::class);
    }

    public function Peoples()
    {
        return $this->belongsTo(Peoples::class);
    }

    public function Item_packaging()
    {
        return $this->belongsTo(Item_packaging::class);
    }
}
