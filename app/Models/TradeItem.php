<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TradeItem extends Model
{
    protected $fillable = ['trade_id', 'item_id', 'direction'];

    public function trade()
    {
        return $this->belongsTo(Trade::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
