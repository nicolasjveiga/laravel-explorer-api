<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTradeRequest;
use App\Services\TradeService;
use Illuminate\Http\JsonResponse;

class TradeController extends Controller
{

    protected $tradeService;

    public function __construct(TradeService $tradeService)
    {
        $this->tradeService = $tradeService;
    }

    public function store(StoreTradeRequest $request): JsonResponse
    {
        try {
            $trade = $this->tradeService->createTrade($request->validated());
            return response()->json($trade->load('tradeItems.item'), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

}
