<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    protected $fillable = ['from_explorer_id', 'to_explorer_id'];

    public function fromExplorer()
    {
        return $this->hasMany(Explorer::class, 'from_explorer_id');
    }

    public function toExplorer()
    {
        return $this->hasMany(Explorer::class, 'to_explorer_id');
    }

    public function tradeItems()
    {
        return $this->hasMany(TradeItem::class);
    }

    public function sentItems()
    {
        return $this->hasMany(TradeItem::class);
    }

    public function receivedItems()
    {
        return $this->hasMany(TradeItem::class);
    }
}
