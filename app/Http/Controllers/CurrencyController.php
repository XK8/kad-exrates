<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Routing\Controller;

class CurrencyController extends Controller
{
    public function index()
    {
        return response()->json(Rate::whereNotNull('updated_at')->get(['id', 'alphabetic_code', 'name', 'english_name', 'digit_code', 'rate']));
    }

    public function show(Rate $rate)
    {
        return response()->json($rate->only(['id', 'alphabetic_code', 'name', 'english_name', 'digit_code', 'rate']));
    }
}
