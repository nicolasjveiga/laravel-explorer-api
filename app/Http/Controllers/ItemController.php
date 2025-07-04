<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\ItemService;
use App\Http\Requests\StoreItemRequest;

class ItemController extends Controller
{
    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index()
    {
        $items = Item::with('explorer', 'tradeItems')->get();
        return response()->json($items);
    }

    public function store(StoreItemRequest $request)
    {
        $validated = $request->validated();

        $item = $this->itemService->createItem($validated);

        return response()->json($item, 201);
    }

    public function show(Item $item)
    {
        $item->load('explorer', 'tradeItems');
        return response()->json($item);
    }

}
