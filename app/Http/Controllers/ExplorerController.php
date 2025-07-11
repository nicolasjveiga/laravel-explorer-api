<?php

namespace App\Http\Controllers;

use App\Models\Explorer;
use App\Services\ExplorerService;
use App\Http\Requests\UpdateExplorerLocationRequest;



class ExplorerController extends Controller
{
    protected $explorerService;

    public function __construct(ExplorerService $explorerService)
    {
        $this->explorerService = $explorerService;
    }

    public function index()
    {
        $explorers = Explorer::with(['items', 'sentTrades', 'receivedTrades'])->get();

        return response()->json($explorers);
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

    public function history(Explorer $explorer)
    {
        return response()->json(['explorer' => $explorer->id, 'history' => $explorer->histories]);
    }
}
