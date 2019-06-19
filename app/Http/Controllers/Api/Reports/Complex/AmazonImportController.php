<?php

namespace App\Http\Controllers\Api\Reports\Complex;

use App\Http\Requests\Api\Reports\Complex\AmazonImportRequest;
use App\Http\Requests\Api\Reports\Complex\FiltersRequest;
use App\Repositories\Reports\AmazonImportRepository;
use App\Utils\Reports\Complex\ConfigManagers\AmazonImportManager;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\AmazonImport\ImportProduct;

class AmazonImportController extends Controller
{
    /**
     * @var AmazonImportRepository
     */
    protected $amazonImportRepository;



    public function __construct( AmazonImportRepository $amazonImportRepository)
    {
        $this->amazonImportRepository = $amazonImportRepository;
    }

    /**
     * @param FiltersRequest $request
     * @return array
     */
    public function index(FiltersRequest $request)
    {
        $manager = (new AmazonImportManager())->manage('web');

        $config = $manager->getConfig();

        $this->amazonImportRepository->setReportConfig($config);

        $response['filters'] = $config->filters();
        $response['data'] = $this->amazonImportRepository->datatable();
        $response['fields'] = $config->blocks();

        return response()->json($response);
    }

    /**
     *
     */
    public function getTemplateFileInfo(ImportProduct $importProduct)
    {
        if(!\Storage::exists($importProduct->fullPath())) {
            return [];
        }
        $lastModified=  \Storage::lastModified($importProduct->fullPath());
        $fileData = [
            'lastModified' => $lastModified,
            'lastModifiedDate' => Carbon::createFromTimestamp($lastModified)->toCookieString(),
            'name' => $importProduct->nameFile(),
            'size' => \Storage::size($importProduct->fullPath()),
            'type' => \Storage::mimeType($importProduct->fullPath()),
            'webkitRelativePath' => '',
        ];
        return $fileData;
    }

    /**
     * @param AmazonImportRequest $request
     */
    public function storeTemplate(AmazonImportRequest $request, ImportProduct $importProduct)
    {

        $request->template_file->storeAs($importProduct->pathToFile(), $importProduct->nameFile());

    }

    /**
     * @param FiltersRequest $request
     */
    public function downloadProducts(FiltersRequest $request, ImportProduct $importProduct)
    {
        $manager = (new AmazonImportManager())->manage('import');

        $config = $manager->getConfig();

        $this->amazonImportRepository->setReportConfig($config);

        $data = $this->amazonImportRepository->all();
        return $importProduct->generateXml($data);
    }

    /**x
     * @param FiltersRequest $request
     */
    public function createImport(FiltersRequest $request)
    {
        return app()->make(ImportProduct::class)->generateXml($request->all());
    }
}
