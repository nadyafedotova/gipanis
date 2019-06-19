<?php

namespace app\Utils\DownloadReportsBuilder\Rows\Excel\X09;

use App\Models\JtlAmzConcatArtikel;
use app\Utils\DownloadReportsBuilder\Rows\Contract\ExcelRowContract;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductRow implements ExcelRowContract
{
    /**
     * @var Worksheet
     */
    protected $sheet;


    /**
     * @var int
     */
    protected $rowNumber;


    /**
     * @var int
     */
    protected $columnNumber;

    /**
     * @var array
     */
    protected $blocks;

    /**
     * @var array
     */
    protected $item;

    /**
     * @var array
     */
    protected $calculated;


    /**
     * @var bool
     */
    protected $hide = false;

    /**
     * ProductRow constructor.
     * @param array $blocks
     * @param array $item
     * @param array $calculated
     * @param $rowNumber
     * @param Worksheet $sheet
     * @param bool $hide
     */
    public function __construct(
        array $blocks,
        array $item,
        array $calculated,
        $rowNumber,
        Worksheet $sheet,
        bool $hide
    )
    {
        $this->sheet = $sheet;

        $this->item = $item;

        $this->calculated = $calculated;

        $this->rowNumber = $rowNumber;

        $this->blocks = $blocks;

        $this->hide = $hide;
    }

    protected function baseBlock()
    {
        $columns = $this->blocks['base'];
        foreach ($columns as $key => $column) {
            $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;

            switch ($column) {
                case 'ID':
                    if($this->item['kType'] == 's' && !empty($_GET['hide_columns'])) {
                        $val = $this->item['cArtNr'];
                    } else {
                        $val = $this->item['ID'];
                    }

                    break;
                case 'Type':
                    if ($this->item['kType'] == 'h') {
                        $type = 'Hauptartikel';
                    } elseif ($this->item['kType'] == 's') {
                        $type = 'Stuecklistenartikel';
                    } elseif ($this->item['kType'] == 'c') {
                        $type = 'Child';
                    } elseif ($this->item['kType'] == 's,c' || $this->item['kType'] == 'c,s') {
                        $type = 'Stuecklistenartikel, Child';
                    }
                    $val = $type;
                    break;
                case 'cHAN':
                    $val = $this->item['cHAN'];
                    break;
                case 'End of life':
                    $val = (!empty($this->item['EndOFLife']) && $this->item['EndOFLife'] == 1 ? 'EoL' : '');
                    break;
                case 'AMA-Logik':
                    $val = (!empty($this->item['AMALogik']) && $this->item['AMALogik'] == 1 ? 'noFBA' : '');
                    break;
                case 'AFN SKU':
                    $val = (!empty($this->item['AFN_SKU']) ? str_replace("\"", "", $this->item['AFN_SKU']) : '');
                    break;
                default:
                    $val = (!empty($this->item[$column]) ? $this->item[$column] : "");
                    break;
            }

            $this->sheet->setCellValue($columnName, $val);
            $this->columnNumber++;
        }

    }

    protected function salesBlock()
    {
        $columns = $this->blocks['sales'];
        foreach ($columns as $salesChanelKey => $salesChanel) {

            $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;

            $countMax = !empty($this->item[$salesChanelKey]) ? (float)$this->item[$salesChanelKey] : 0;

            $this->sheet->setCellValue($columnName, $countMax);
            $this->columnNumber++;
        }

    }

    protected function inStockBlock()
    {
        $product = $this->calculated[$this->item['kArtikel']];
        $columns = $this->blocks['in_stock'];
        foreach ($columns as $inStockBlockKey => $inStockBlockTitle) {
            if (is_null($this->item[$inStockBlockKey])) {
                $this->item[$inStockBlockKey] = 0;
            }
            if (is_null($product[$inStockBlockKey])) {
                $product[$inStockBlockKey] = 0;
            }

            $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;

            $countMax = !empty($this->item[$inStockBlockKey]) ? (int)$this->item[$inStockBlockKey] : $product[$inStockBlockKey];
            if ($inStockBlockKey == 'JTLInStockDays' || $inStockBlockKey == 'AMZInStockDays') {
                if ($countMax == JtlAmzConcatArtikel::IN_STOCK) {
                    $countMax = '';
                }
            }
            if ($this->inAMZQuntity($inStockBlockKey) && $countMax == 0) {
                $countMax = '';

            }
            $this->sheet->setCellValue($columnName, $countMax);

            $this->columnNumber++;
        }

    }

    protected function inAMZQuntity($inStockBlockKey)
    {
        if (in_array($inStockBlockKey,
            [
                'reserved_fc_transfers',
                'reserved_fc_processing',
                'afn_inbound_working_quantity',
                'afn_inbound_shipped_quantity',
                'afn_inbound_receiving_quantity'
            ])) {

            return true;
        }

        return false;
    }

    protected function ratingBlock()
    {
        if (empty($this->item['rating'])) {
            $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;
            $this->sheet->setCellValue($columnName, '');
            $this->columnNumber++;
            $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;
            $this->sheet->setCellValue($columnName, '');
            $this->columnNumber++;
        } else {

            $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;
            $this->sheet->setCellValue($columnName, $this->item['rating']);
            $this->columnNumber++;
            $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;
            $this->sheet->setCellValue($columnName, $this->item['total_number_reviews']);
            $this->columnNumber++;
        }
    }

    protected function calculateBlock()
    {
        $calculate = $this->calculated[$this->item['kArtikel']]["calculate"];
        $columns = $this->blocks['calculator'];
        foreach ($columns as $calculatorKey => $calculatorTitle) {

            $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;

            $val = !empty($calculate[$calculatorKey]) ? (int)$calculate[$calculatorKey] : 0;

            $this->sheet->setCellValue($columnName, $val);
            $this->columnNumber++;

        }
    }


    public function row()
    {
        $lastColNumber = 0;

        $this->baseBlock();
        $lastColNumber += $this->columnNumber;
        $this->ratingBlock();
        $lastColNumber += $this->columnNumber;
        $this->salesBlock();
        $lastColNumber += $this->columnNumber;
        $this->inStockBlock();
        $lastColNumber += $this->columnNumber;
        $this->calculateBlock();
        $lastColNumber += $this->columnNumber;

        $sendToAmz = $this->calculated[$this->item['kArtikel']]['calculate']['afnStockToGo'];
        $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;

        if (!is_array($sendToAmz)) {
            $val = $sendToAmz;
        } else {
            $val = $sendToAmz[0];
        }

        $this->sheet->setCellValue($columnName, $val);

        $this->lastColNumber++;
        $this->setColorRows($lastColNumber);

        $this->setBoldText($columnName);


        return $this->sheet;
    }

    protected function setColorRows(int $lastColNumber)
    {
        $color = $this->getColor($this->rowNumber);
        $firstColumn = 'A' . $this->rowNumber;
        $lastColumn = excel_column_name($lastColNumber) . $this->rowNumber;
        $cell = $firstColumn . ':' . $lastColumn;

        $this->sheet->getStyle($cell)->getFill()->applyFromArray(
            [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 0,
                'color' => [
                    'rgb' => $color
                ]
            ]
        );
    }

    protected function setBoldText( string $cell)
    {
        $fontStyle = new \PhpOffice\PhpSpreadsheet\Style\Font();
        $fontStyle->setBold(true);
        $this->sheet->getStyle($cell)->getFont()->applyFromArray(
            [
                'bold' => true,
            ]
        );
    }

    protected function getColor(): string
    {
        if ($this->rowNumber % 2 == 0) {
            return $this->colorEven();
        } else {
            return $this->colorOdd();
        }
    }

    protected function colorOdd(): string
    {
        return 'ffffff';
    }

    protected function colorEven(): string
    {
        return 'ddd9c4';
    }
}