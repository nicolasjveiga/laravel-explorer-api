<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\RegisterExplorerRequest;
use App\Services\ExplorerService;

class AuthController extends Controller
{
    protected $explorerService;

    public function __construct(ExplorerService $explorerService)
    {
        $this->explorerService = $explorerService;
    }


    public function register(RegisterExplorerRequest $request)
    {
        $data = array_merge(
            $request->only(['name','email','age','latitude','longitude']),
            ['password' => bcrypt($request->password)]
        );
        $explorer = $this->explorerService->createExplorer($data);
        $token    = $explorer->createToken('ExplorerToken')->plainTextToken;
        return response()->json(['explorer'=>$explorer,'token'=>$token], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $explorer = $this->explorerService->findByEmail($request->email);

        if (! $explorer || ! Hash::check($request->password, $explorer->password)) {
            throw ValidationException::withMessages([
                'email' => ['Credenciais incorretas.'],
            ]);
        }

        $token = $explorer->createToken('ExplorerToken')->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
