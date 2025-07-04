<?php

namespace App\Services;
use App\Models\Item;

class ItemService
{
    public function createItem(array $data): Item
    {
        return Item::create([
            'name' => $data['name'],
            'value' => $data['value'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'explorer_id' => $data['explorer_id'],
        ]);
    }

}
