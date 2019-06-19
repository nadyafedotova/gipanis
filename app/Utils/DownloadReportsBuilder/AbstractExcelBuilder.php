<?php

namespace App\Utils\DownloadReportsBuilder;

use App\Utils\DownloadReportsBuilder\Contract\FileBuilderContract;
use App\Utils\Reports\Complex\Contract\ReportsConfigContract;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

abstract class AbstractExcelBuilder implements FileBuilderContract
{
    /**
     * @var ReportsConfigContract
     */
    protected $config;

    /**
     * @var Spreadsheet
     */
    protected $spreadsheet;

    protected $sheet = null;

    /**
     * @var array
     */
    protected $params = [];


    public function __construct(ReportsConfigContract $config)
    {
        $this->config = $config;
    }

    public function build($data) {
        setlocale(LC_ALL, 'de_DE');
        ini_set('memory_limit', '8192M');
        set_time_limit(0);
        ini_set('max_execution_time', 0);

        $headers = [
            'Content-Type' => 'application/vnd.ms-excel',
            'Cache-Control' => 'max-age=0'
        ];

        $this->spreadsheet = new Spreadsheet();
        $products = $data['products'];

        $this->setParams($data);
        if(!$this->onPrint()) {
            $this->sheet = $this->spreadsheet->getActiveSheet();
            $rowNumber = 0;
            $page = 0;
        } else {
            $this->sheet = $this->createSheetPrint(0);
        }
        foreach ($products as $product) {
            if($this->onPrint()) {
                if ($rowNumber % 182 == 0) {
                    $this->sheet = $this->createSheetPrint($page);
                    $rowNumber = 2;

                    $page++;
                }
            }
            $this->rows($product);
        }
        $writer = new Xlsx($this->spreadsheet);
        return response()->download(
            $writer->save('php://output'),
            'x09_' . Carbon::now()->format('d_m_Y') . '.xlsx',
            $headers
        );
    }

    abstract protected function head($sheet);

    abstract protected function rows($product);

    protected function setParams($data)
    {
        if(isset($data['params']) && is_array($data['params'])) {
            $this->params = $data['params'];
        }
    }

    protected function onPrint()
    {
        return false;
    }

    /**
     * @param $page
     * @return \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet
     */
    protected function createSheetPrint($page)
    {
        $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($this->spreadsheet,  ' Page '.((int)$page + 1) );
        $this->spreadsheet->addSheet($myWorkSheet, $page);
        $sheet = $this->spreadsheet->setActiveSheetIndex($page);

//        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getPageSetup()->setOrientation(PageSetup::ORIENTATION_PORTRAIT);
        $sheet->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);
        $sheet->getPageSetup()->setFitToPage(true);
        $sheet->getPageSetup()->setFitToWidth(1);
        $sheet->getPageSetup()->setFitToHeight(0);
        $this->head($sheet);
        return $sheet;
    }


}