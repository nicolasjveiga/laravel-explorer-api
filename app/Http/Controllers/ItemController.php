<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('explorer', 'tradeItems')->get();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'value' => 'required|numeric|min:0',
            'explorer_id' => 'required|exists:explorers,id',
        ]);

        $item = Item::create($request->all());

        return response()->json($item, 201);
    }

    public function show(Item $item)
    {
        $item->load('explorer', 'tradeItems');
        return response()->json($item);
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'value' => 'sometimes|required|numeric|min:0',
            'explorer_id' => 'sometimes|required|exists:explorers,id',
        ]);

        $item->update($request->all());

        return response()->json($item);
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(null, 204);
    }
}
