<?php

namespace Service\X09;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InStuecklistenRow
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
    protected $parent;

    /**
     * @var bool
     */
    protected $hide = false;

    /**
     * InStuecklistenRow constructor.
     * @param array $blocks
     * @param array $item
     * @param array $parent
     * @param Worksheet $sheet
     * @param int $rowNumber
     * @param bool $hide
     */
    public function __construct(
        array $blocks,
        array $item,
        array $parent,
        Worksheet $sheet,
        int $rowNumber,
        bool $hide = false
    )
    {
        $this->sheet = $sheet;

        $this->item = $item;

        $this->parent = $parent;

        $this->rowNumber = $rowNumber;

        $this->blocks = $blocks;

        $this->hide = $hide;
    }

    protected function baseBlock()
    {
        $columns = $this->blocks['base'];
        foreach ($columns as $key => $column) {

            $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;
            if ($key == 'ID') {
                if ($this->hide) {
                    $val = $this->item['cArtNr'] . '(fAnzahl ' . $this->item['fAnzahl'] . ') ';
                } else {
                    $val = ' - ';
                }
            } elseif ($key == 'cArtNr') {
                if ($this->hide) {
                    continue;
                } else {
                    $val = $this->item['cArtNr'];
                };
            } elseif ($key == 'kType') {
                $val = '(fAnzahl ' . $this->item['fAnzahl'] . ') ';
            } else {
                $val = ' - ';
            }

            $this->sheet->setCellValue($columnName, $val);
            $this->columnNumber++;
        }

    }

    protected function salesBlock()
    {
        $columns = $this->blocks['sales'];
        foreach ($columns as $salesChanelKey => $salesChanel) {

            switch ($salesChanelKey) {
                case 'MFNSales':
                    $val = $this->parent['MFNSales'] * $this->item['fAnzahl'];
                    break;
                case 'AFNSales':
                    $val = $this->parent['AFNSales'] * $this->item['fAnzahl'];
                    break;
                case 'MFNTotalSales':
                    $val = $this->parent['MFNTotalSales'] * $this->item['fAnzahl'];
                    break;
                case 'AFNTotalSales':
                    $val = $this->parent['AFNTotalSales'] * $this->item['fAnzahl'];
                    break;
            }
            $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;


            $this->sheet->setCellValue($columnName, $val);
            $this->columnNumber++;
        }

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
        $calculate = $this->item['calculator'];

        $columns = $this->blocks['calculator'];

        foreach ($columns as $calculatorKey => $calculatorTitle) {

            $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;

            $val = !empty($calculate[$calculatorKey]) ? (int)$calculate[$calculatorKey] : 0;

            $this->sheet->setCellValue($columnName, $val);
            $this->columnNumber++;

        }
    }

    protected function inStockBlock()
    {
        $columns = $this->blocks['in_stock'];

        foreach ($columns as $key => $column) {
            $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;

            $this->sheet->setCellValue($columnName, '');
            $this->columnNumber++;
        }
    }

    public function row()
    {
        $this->columnNumber = 0;

        $this->baseBlock();

        $this->ratingBlock();

        $this->salesBlock();

        $this->inStockBlock();

        $this->calculateBlock();

        $columnName = excel_column_name($this->columnNumber) . $this->rowNumber;
        $val = $this->parent['calculate']['afnStockToGo']['composite_artikel'][$this->item['kArtikel']];

        $this->sheet->setCellValue($columnName, $val);

        return $this->sheet;
    }
}