<?php

namespace App\Services;
use App\Models\Explorer;
use App\Models\History;

class ExplorerService
{
    public function createExplorer(array $data): Explorer
    {
        return Explorer::create([
            'name' => $data['name'],
            'age' => $data['age'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);
    }

    public function updateLocation(Explorer $explorer, array $data): Explorer
    {

        History::create([
            'explorer_id' => $explorer->id,
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);

        $explorer->update([
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);

        return $explorer;
    }
}
