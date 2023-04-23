<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExchangeRate extends Model
{
    //use HasFactory;
    protected $fillable = ['date', 'currencies_id', 'amount'];
    
    public static function getRates(string $date, string $currency) 
    {
        /* Disable ONLY_FULL_GROUP_BY causing SQLSTATE[42000]: Syntax error or access violation: 1055 */
        $original_sqlmode = DB::select('SELECT @@sql_mode AS sql_mode;');
        $sqlmode = str_replace('ONLY_FULL_GROUP_BY', '', $original_sqlmode[0]->sql_mode);
        DB::statement(sprintf("SET SQL_MODE='%s'", $sqlmode)); //
        /* END */
        
        $exchangerates = self::select(
            DB::raw('MAX(date) AS date'),
            'currencies.symbol as currency',
            DB::raw('(SELECT ROUND(er.amount, 2) FROM exchange_rates AS er WHERE er.id=MAX(exchange_rates.id)) AS amount'),
            'currencies.quantity')
            ->join('currencies', 'exchange_rates.currencies_id', '=', 'currencies.id')
            ->whereDate('date', '<=', $date);
            
            if (!empty($currency)) {
                $exchangerates = $exchangerates->where(DB::raw('UPPER(currencies.symbol)'), strtoupper($currency));
            }
            
            $exchangerates = $exchangerates->groupBy('exchange_rates.currencies_id')->get();
            
            if($exchangerates->count()>0) {
                return $exchangerates;
            } else {
                return ['message' => 'No data'];
            }
    }
    
    public static function addRate(Request $request) 
    {
        $currency = Currency::select('id')->where('symbol', $request->input('currency'))->first();
        if(null===$currency) {
            $currency = Currency::create(['symbol' => $request->input('currency'), 'quantity' => round($request->input('quantity'), 4)]);
        }
        
        $currency_id = $currency->id;
        
        $match = ['date' => $request->input('date'), 'currencies_id' => $currency_id];
        self::updateOrCreate($match,['amount' => $request->input('amount')]);
              
        return ['status' => true, 'message' => 'Currency exchange rate successfully added or updated']; 
    }
}
