<?php

namespace App\Http\Controllers\Api\DataTable;

use App\Exceptions\DataTableException;
use App\Utils\Reports\Complex\Datatables\FilterSettings\FilterConfiguration;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterSettingsController extends Controller
{


    public function __invoke(Request $request, $code)
    {
        $filters = [];
        try  {
            $filterConfiguration = new FilterConfiguration();
            $filters = $filterConfiguration->make($code);
            return \Response::json(['filters' => $filters], 200);
        } catch (DataTableException $exception) {
            return \Response::json(['error' => $exception], 422);
        }



    }
}
