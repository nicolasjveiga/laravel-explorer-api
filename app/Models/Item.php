<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'value', 'latitude', 'longitude', 'explorer_id'];

    public function explorer()
    {
        return $this->belongsTo(Explorer::class);
    }

    public function tradeItems()
    {
        return $this->hasMany(TradeItem::class);
    }
}
