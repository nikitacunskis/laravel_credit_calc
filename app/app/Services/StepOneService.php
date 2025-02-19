<?php

namespace App\Services;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StepOneService
{
    public function handle(Request $request)
    {
        $maxAmount = config('loan.maximum_amount');
        $minAmount = config('loan.minimum_amount');
        $maxTime = config('loan.maximum_time');
        $minTime = config('loan.minimum_time');

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'agree' => 'required|boolean',
            'amount' => 'required|numeric|min:'.$minAmount.'|max:'.$maxAmount,
            'time' => 'required|integer|min:'.$minTime.'|max:'.$maxTime,
        ]);

        if ($validator->fails()) 
        {

            return response()->json([
                'errors' => $validator->errors(),
            ], 400);
        }

        $loan = Loan::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'agreed_with_rules' => $request->agree,
            'amount' => $request->amount,
            'time' => $request->time,
            'step' => 1,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Loan application successfully created.',
            'loan' => $loan,
        ]);
    }
}
