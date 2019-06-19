<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Auth\Auth;
use App\Http\Controllers\Controller;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user =auth()->user();
        return view('backend.dashboard');
    }
}
