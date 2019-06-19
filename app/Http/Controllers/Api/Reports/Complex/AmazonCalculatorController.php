<?php

namespace App\Http\Controllers\Api\Reports\Complex;

use app\Http\Requests\Api\Reports\Complex\Calculator\AmazonCalculatorExelRequest;
use App\Http\Requests\Api\Reports\Complex\Calculator\AmazonCalculatorRequest;
use App\Repositories\Reports\AmazonCalculatorRepository;
use App\Utils\Calculator\CalculateAmzSend;
use App\Utils\Calculator\Calculator;
use App\Utils\DownloadReportsBuilder\Builder\X09ExcelBuilder;
use App\Utils\Reports\Complex\AmazonCalculatorConfig;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmazonCalculatorController extends Controller
{
    protected $repository;

    public function __construct(AmazonCalculatorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(AmazonCalculatorRequest $request)
    {
        $config = app()->make(AmazonCalculatorConfig::class);

        $this->repository->setReportConfig($config);
        $fields = $config->blocks();
        $filters = $config->filters();

        $productForCalculator = $this->repository->getForCalculate();

        $calculate = app()->make(Calculator::class, ['products' => $productForCalculator, 'interval' => $request->get('interval', 21)]);

        $calculated = $calculate->calculate();

        $calculatedProducts = (new CalculateAmzSend($calculated['productsByKArtikel'], $calculated['available']))->calculate();

        $data = $this->repository->datatable();

        return response()->json([
            'fields' => $fields,
            'filters' => $filters,
            'data' => $data,
            'calculated' => $calculatedProducts,
        ]);
    }

    public function excel(AmazonCalculatorExelRequest $request)
    {
        $config = app()->make(AmazonCalculatorConfig::class);

        $productForCalculator = $this->repository->getForCalculate();

        $calculate = app()->make(Calculator::class, ['products' => $productForCalculator, 'interval' => $request->get('interval', 21)]);

        $calculated = $calculate->calculate();

        $calculatedProducts = (new CalculateAmzSend($calculated['productsByKArtikel'], $calculated['available']))->calculate();

        $data = $this->repository->datatable();

        app()->make(X09ExcelBuilder::class, ['config' => $config])->build(['products' => $data, 'params' => ['calculated' => $calculatedProducts]]);

    }
}
