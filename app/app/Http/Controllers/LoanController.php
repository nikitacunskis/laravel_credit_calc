<?php

namespace App\Http\Controllers;

use App\Factories\StepServiceFactory;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function makeStep($step, Request $request)
    {
        $service = StepServiceFactory::create($step, $request);
        return $service->handle($request);
    }
}
