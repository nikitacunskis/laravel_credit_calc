<?php

namespace App\Factories;

use App\Services\StepOneService;
use Illuminate\Http\Request;

class StepServiceFactory
{
    public static function create(int $step, Request $request)
    {
        if ($step === 1) {
            return new StepOneService($request);
        }
    }
}
