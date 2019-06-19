<?php

namespace App\Http\Controllers\Backend\Reports\Complex;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmazonCalculatorController extends Controller
{
    public function index()
    {
        return view('backend.reports.complex.amzcalculator');
    }
}
