<?php

namespace App\Services;

use App\Models\Trade;
use App\Models\TradeItem;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class TradeService
{
    public function createTrade(array $data): Trade
    {
        return DB::transaction(function () use ($data) {
            $sentItems = Item::whereIn('id', $data['sent_items'])->get();
            $receivedItems = Item::whereIn('id', $data['received_items'])->get();

            foreach ($sentItems as $item) {
                if ($item->explorer_id != $data['from_explorer_id']) {
                    throw new \Exception("Item {$item->id} não pertence ao explorador de origem.");
                }
            }

            foreach ($receivedItems as $item) {
                if ($item->explorer_id != $data['to_explorer_id']) {
                    throw new \Exception("Item {$item->id} não pertence ao explorador de destino.");
                }
            }

            $sentValue = $sentItems->sum('value');
            $receivedValue = $receivedItems->sum('value');

            if ($sentValue != $receivedValue) {
                throw new \Exception("Valores trocados não são equivalentes.");
            }

            $trade = Trade::create([
                'from_explorer_id' => $data['from_explorer_id'],
                'to_explorer_id' => $data['to_explorer_id'],
            ]);

            foreach ($sentItems as $item) {
                TradeItem::create([
                    'trade_id' => $trade->id,
                    'item_id' => $item->id,
                    'direction' => 'sent',
                ]);
            }

            foreach ($receivedItems as $item) {
                TradeItem::create([
                    'trade_id' => $trade->id,
                    'item_id' => $item->id,
                    'direction' => 'received',
                ]);
            }

            foreach ($sentItems as $item) {
                $item->update([
                'explorer_id' => $data['to_explorer_id'],
                ]);
            }

            foreach ($receivedItems as $item) {
                $item->update([
                    'explorer_id' => $data['from_explorer_id'],
                ]);
            }


            return $trade;
        });
    }

}