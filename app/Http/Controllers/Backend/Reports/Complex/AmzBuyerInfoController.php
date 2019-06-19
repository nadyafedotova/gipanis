<?php

namespace App\Http\Controllers\Backend\Reports\Complex;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmzBuyerInfoController extends Controller
{
    public function index()
    {
        return view('backend.reports.complex.amzbuyerinfo');
    }
}
