<?php

namespace App\Services;

use App\Models\Explorer;

class ExplorerService
{
    /**
     * @param  array  $data
     * @return Explorer
     */
    public function createExplorer(array $data): Explorer
    {

        return Explorer::create($data);
    }

    /**
     * @param  string  $email
     * @return Explorer|null
     */
    public function findByEmail(string $email): ?Explorer
    {
        return Explorer::where('email', $email)->first();
    }

    /**
     * @param  Explorer  $explorer
     * @param  array     $data
     * @return Explorer
     */
    public function updateLocation(Explorer $explorer, array $data): Explorer
    {
        $explorer->histories()->create([
            'latitude'  => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);

        $explorer->update([
            'latitude'  => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);

        return $explorer;
    }
}
