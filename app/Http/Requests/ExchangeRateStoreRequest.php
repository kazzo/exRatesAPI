<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Validator;

class ExchangeRateStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(Request $request): bool    
    {
        $user = Auth::guard('api')->user();
        
        if(!in_array($user->role , 	['ADMIN', 'ADDER'])) {
            throw new HttpResponseException(response()->json(['message' => 'You not have right to access this resource'], 403));
        }
        
        $request->merge(['currency' => trim(strtoupper($request->input('currency')))]);
        $request->merge(['quantity' => $request->input('quantity') ?? 1]);
        
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'currency' => 'required|alpha|min:3|max:3',            
            'amount' => 'required|numeric|gt:0',
            'date' => 'required|date|date_format:Y-m-d|before:tomorrow',
        ];
    }
        
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], 401));                
    }
}
