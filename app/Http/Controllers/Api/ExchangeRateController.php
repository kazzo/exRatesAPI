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
//use App\Http\Requests\ExchangeRateIndexRequest;
use App\Http\Requests\ExchangeRateIndexRequest;
use App\Http\Requests\ExchangeRateStoreRequest;

class ExchangeRateController extends Controller
{
    public function index(ExchangeRateIndexRequest $request, string $date, string $currency='')
    {
        try{
            return response()->json(ExchangeRate::getRates($date, $currency), 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
                
    }
       
    public function store(ExchangeRateStoreRequest $request)
    {
/*        
        $user = Auth::guard('api')->user();
        if(!in_array($user->role , 	['ADMIN']))
            return response()->json(['message' => 'You not have right to access this resource'], 403);
        
        $request->validate([
            'currency' => 'required|alpha|min:3|max:3',            
            'amount' => 'required|numeric|gt:0',
            'date' => 'required|date|date_format:Y-m-d|before:tomorrow'
        ]);
        
        $request->merge(['currency' => trim(strtoupper($request->input('currency')))]);
        $request->merge(['quantity' => $request->input('quantity') ?? 1]);        
*/
        try{
            return response()->json(ExchangeRate::addRate($request), 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()], 500);
        }
    }
    
}
