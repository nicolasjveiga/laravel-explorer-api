<?php

namespace App\Services;
use App\Models\Explorer;

class ExplorerService
{
    public function UpdateLocation(Explorer $explorer, array $data): Explorer
    {
        $explorer->update([
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);

        return $explorer;
    }
}
