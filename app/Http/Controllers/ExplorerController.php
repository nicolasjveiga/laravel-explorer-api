<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use Illuminate\Http\Request;
use App\Services\ExplorerService;
use App\Http\Requests\UpdateExplorerLocationRequest;



class ExplorerController extends Controller
{
    public function __construct(ExplorerService $explorerService)
    {
        $this->explorerService = $explorerService;
    }

    public function index()
    {
        $explorers = Explorer::with(['items', 'sentTrades', 'receivedTrades'])->get();

        return response()->json($explorers);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $explorer = Explorer::create($request->all());

        return response()->json($explorer, 201);
    }

    public function show(Explorer $explorer)
    {
        $explorer->load(['items', 'sentTrades', 'receivedTrades']);

        return response()->json($explorer);
    }

    public function update(UpdateExplorerLocationRequest $request, Explorer $explorer)
    {
        $validated = $request->validated();
        $explorer = $this->explorerService->updateLocation($explorer, $validated);
        return response()->json($explorer);
    }
}
