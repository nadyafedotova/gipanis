<?php

namespace App\Utils\DownloadReportsBuilder\Builder;

use App\Utils\DownloadReportsBuilder\AbstractExcelBuilder;
use app\Utils\DownloadReportsBuilder\Rows\Excel\X09\ProductRow;
use App\Utils\Reports\Complex\Contract\ReportsConfigContract;
use Illuminate\Http\Request;
use Service\X09\InStuecklistenRow;

class X09ExcelBuilder extends AbstractExcelBuilder
{
    protected $request;

    protected $productRow;

    protected $complexProductRow;

    protected $hide = [
        'cArtNr',
        'Type',
        'AMALogik',
        'AFN_SKU',
        'cBarcode',
        'EAN',
        'ASIN',
        'MFNSales',
        'AFNSales',
        'afn_reserved_quantity',
        'reserved_customerorders',
        'demandMFN',
        'demandMFNParent',
        'demandAFN',
        'demandAFNParent',
        'totalDemandSingle',
        'afnStockNeeded',
        'afnStockNeededParent',
        'availableForAFN',
    ];

    protected $filters = [
        'sendToAmz' => 0,
        'withoutComplex' => 0,
        'amaLogik' => 0,
        'hide' => 0,
    ];

    protected $calculated;

    public function __construct(Request $request, ReportsConfigContract $config)
    {
        parent::__construct($config);
        $this->request = $request;

        $this->getExportFilters();
        $this->hideFields();

    }

    protected function head($sheet)
    {
        $i = 0;
        $allColumn = $this->config->blocks();
        foreach ($allColumn as $columnTitle) {
            $columnName = excel_column_name($i) . '1';
            $sheet->setCellValue($columnName, $columnTitle);
            $i++;
        }
    }

    protected function rows($product)
    {
        $calculated = $this->params['calculated'];
        $sendToAmz = $calculated[$product['main']['kArtikel']]['calculate']['afnStockToGo'];

        if (
            (($this->filters['sendToAmz'] == 1 && (!empty($sendToAmz))) || empty($this->filters['sendToAmz']))
            && ($this->filters['amaLogik'] == 1 && $product['main']['AMALogik'] == 0 || empty($this->filters['amaLogik']))
        ) {
            $params = ['simple', [$this->config->blocks(), $product['main'], $this->params['calculated'], $rowNumber, $this->sheet]];
            app()->make(ProductRow::class, $this->setRowParam(...$params))->row();
            $rowNumber++;
        }

        if (!empty($product['complex']) && $this->filters['withoutComplex'] !== 1) {
            foreach ($product['complex'] as $stuecklisten) {
                $sendToAmz = $calculated[$stuecklisten['kArtikel']]['calculate']['afnStockToGo'][0];
                if (
                    ($this->filters['sendToAmz'] == 1 && (!empty($sendToAmz)) || empty($this->filters['sendToAmz']))
                    && ($this->filters['sendToAmz'] == 1 && $stuecklisten['AMALogik'] == 0 || empty($this->filters['sendToAmz']))
                ) {
                    $params = ['simple', [$this->config->blocks(), $stuecklisten, $this->params['calculated'], $rowNumber, $this->sheet]];
                    app()->make(ProductRow::class, $this->setRowParam(...$params))->row();
                    $rowNumber++;

                    $compositeArtikel = !empty($calculated[$stuecklisten['kArtikel']]['composite_artikel']) ? $calculated[$stuecklisten['kArtikel']]['composite_artikel'] : [];
                    if (!empty($compositeArtikel)) {
                        $parent = $calculated[$stuecklisten['kArtikel']];
                        foreach ($compositeArtikel as $inStucklisten) {
                            $params = ['complex', [$this->config->blocks(), $inStucklisten, $parent, $rowNumber, $this->sheet]];
                            app()->make(InStuecklistenRow::class, $this->setRowParam(...$params))->row();
                            $rowNumber++;
                        }
                    }
                }
            }
        }
    }

    protected function getExportFilters()
    {
        $this->filters = [
            'sendToAmz' => $this->request->get('send_to_amazon', 0),
            'withoutComplex' => $this->request->get('without_in', 0),
            'amaLogik' => $this->request->get('ama_logik', 0),
            'hide' => $this->request->get('hide', 0),
        ];

    }

    protected function onPrint(): bool
    {
        if (
            !$this->filters['sendToAmz']
            && !$this->filters['withoutComplex']
            && !$this->filters['amaLogik']
            && !$this->filters['hide']
        ) {
            return false;
        }

        return true;
    }

    protected function hideFields()
    {
        if (!$this->request->get('hide', 0)) {
            return;
        }
        $fields = $this->config->blocks();
        $hide = $this->hide;
        foreach ($fields as $blockName => $columns) {
            for ($i = 0; $i < count($hide); $i++) {
                $hideColumn = $hide[$i];

                if (!empty($columns[$hideColumn])) {
                    unset($hide[$i]);
                    unset($columns[$hideColumn]);
                }
            }
            $newFields[$blockName] = $columns;
        }
        if (!empty($newFields)) {
            $this->config->setBlocks($newFields);
        }

    }

    protected function setRowParam($type = 'simple', $arguments) {
        return ($type == 'simple')?
            [
                'blocks'=>$arguments[0],
                'item'=>$arguments[1],
                'calculated'=>$arguments[2],
                'rowNumber'=>$arguments[3],
                'sheet'=>$arguments[4],
                'hide'=>$arguments[5],
            ] :
            [
                'blocks'=>$arguments[0],
                'item'=>$arguments[1],
                'parent'=>$arguments[2],
                'rowNumber'=>$arguments[3],
                'sheet'=>$arguments[4],
                'hide'=>$arguments[5],
            ];
    }
}