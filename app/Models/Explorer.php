<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Explorer extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'age', 'latitude', 'longitude'];

    protected $hidden = ['password', 'remember_token'];

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

    public function histories()
    {
        return $this->hasMany(History::class);
    }

}
