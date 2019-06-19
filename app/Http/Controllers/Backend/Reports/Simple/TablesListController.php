<?php

namespace App\Http\Controllers\Backend\Reports\Simple;

use App\Repositories\ReportsConfigRepository;
use App\Repositories\TableSearchRepository;
use App\Utils\Reports\Simple\TableBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TablesListController extends Controller
{
    protected $reportsConfigRepository;

    public function __construct(
        ReportsConfigRepository $reportsConfigRepository,
        TableBuilder $tableBuilder
    )
    {
        $this->reportsConfigRepository = $reportsConfigRepository;
        $this->tableBuilder = $tableBuilder;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $code)
    {

        $reportsConfig = $this->reportsConfigRepository->getByColumn($code,'code');

        return view('backend.tables_list.table', compact( 'reportsConfig'));

    }
}
