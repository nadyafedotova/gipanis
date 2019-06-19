<?php

namespace App\Http\Controllers\Api\Reports\Simple;

use App\Helpers\General\InitModel;
use App\Repositories\ReportsConfigRepository;
use App\Repositories\TableSearchRepository;
use App\Utils\Reports\Simple\TableBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TablesListController extends Controller
{
    protected $tableBuilder;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $code)
    {
        $reportsConfig = $this->reportsConfigRepository->getByColumn($code, 'code');
        return $this->tableBuilder->builder($code);

    }

    public function getFields(Request $request, $code)
    {
        $model = app()->make(InitModel::class)->getByCode($code);
        $this->tableBuilder->setFieldsBuilder($model);
        return ['fields' => $this->tableBuilder->getFieldsBuilder()->builder()];
    }
}
