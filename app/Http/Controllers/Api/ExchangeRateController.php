<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ExchangeRateIndexRequest;
use App\Http\Requests\ExchangeRateStoreRequest;

class ExchangeRateController extends Controller
{
    public function index(ExchangeRateIndexRequest $request, string $date, string $currency='')
    {
        try {
            return response()->json(ExchangeRate::getRates($date, $currency), 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
                
    }
       
    public function store(ExchangeRateStoreRequest $request)
    {
        try {
            return response()->json(ExchangeRate::addRate($request), 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }
    
}
