<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Explorer extends Model
{
    protected $fillable = ['name', 'age', 'latitude', 'longitude'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function sentTrades()
    {
        return $this->hasMany(Trade::class, 'from_explorer_id');
    }

    public function receivedTrades()
    {
        return $this->hasMany(Trade::class, 'to_explorer_id');
    }
}
