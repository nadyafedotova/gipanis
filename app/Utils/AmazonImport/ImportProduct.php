<?php

namespace App\Utils\AmazonImport;

use App\Exceptions\GeneralException;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;

class ImportProduct
{
    use Columns;

    protected $file_path = 'amz_product_import';

    protected $file_name = 'converted_import_template.txt';

    /**
     * @var
     */
    protected $file;

    /**
     * @var Active Sheet
     */
    protected $sheet;

    /**
     * @var array
     */
    protected $header = [];

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * @var array
     */
    protected $attributesCell = [];

    /**
     * @var
     */
    protected $model;

    /**
     * @var bool
     */
    protected $rowError = false;

    protected $bulletPointOutOfLimit = false;

    /**
     * @var array
     */
    protected $listCellError = [];


    public function generateXml($data)
    {
        ini_set('memory_limit', '8192M');
        set_time_limit(0);
        ini_set('max_execution_time', 0);

        if (!\Storage::exists($this->fullPath())) {
            throw new GeneralException('Template file on Amazon not found! Please download the template again.');
        }
        $this->file = \Storage::get($this->fullPath());

        $this->header = explode("\n", $this->file);
        $this->attributes = explode("\t", $this->header[2]);
        $spreadsheet = new Spreadsheet();
        $this->sheet = $spreadsheet->getActiveSheet();

        $this->generateHeader();
        $i = 4;

        foreach ($data as $item) {
            $this->rowError = false;
            $this->listCellError = [];
            $this->model = $item;
            $this->bulletPointOutOfLimit = $this->isBulletPointOutOfLimit();
            $this->generateColumn($i);
            if ($this->rowError == true) {

                $this->cellColor('A' . $i . ':' . $this->getLastCell() . $i, 'dc5e75');
                $this->listCellColor($this->listCellError, 'dcd85e');
            }

            $i++;
        }
        $writer = new Xlsx($spreadsheet);
//        dd($writer->save('php://output'));
        return response()->download(
            $writer->save('php://output'),
            'x04_amz_import_' . Carbon::now()->format('d_m_Y') . '.xlsx'
        );
    }

    public function pathToFile()
    {
        return $this->file_path;
    }

    public function nameFile()
    {
        return $this->file_name;
    }

    public function fullPath()
    {
        return $this->file_path . '/' . $this->file_name;
    }

    protected function generateHeader()
    {
        for ($i = 0; $i < count($this->header); $i++) {
            $id = 0;
            $columns = explode("\t", $this->header[$i]);
            foreach ($columns as $columnVal) {
                if (strpos($columnVal, "Infos zu") !== false) {
                    $columnVal = 'Infos zu "Rechtliche Hinweise"';
                }
                $columnName = excel_column_name($id);

                if ($i == 2) {
                    $this->attributesCell[$columnName] = $columnVal;
                }

                $this->sheet->setCellValue($columnName . ($i + 1), $columnVal);
                $id++;
            }
        }

    }

    protected function generateColumn($i)
    {
        $id = 0;

        foreach ($this->attributes as $attribute) {
            $byteLimit = null;
            if (method_exists($this, $attribute)) {
                $columnVal = preg_replace('/\s+/', ' ', $this->$attribute());
            } else {
                $columnVal = '';
            }
            $columnIndex = excel_column_name($id);

            $byteLimit = $this->getByteLimit($columnIndex);
            $notEmpty = $this->getNotEmpty($columnIndex);

            if (strpos($attribute, 'bullet_point') !== false && $this->bulletPointOutOfLimit == true) {
                $this->rowError = true;
                $this->listCellError[] = $columnIndex . $i;

            } elseif (!is_null($byteLimit) && $this->isOutByteLimit($columnVal, $byteLimit)) {

                $this->rowError = true;
                $this->listCellError[] = $columnIndex . $i;
            } elseif ($notEmpty !== false && $this->isEmpty($columnVal)) {
                $this->rowError = true;
                $this->listCellError[] = $columnIndex . $i;
            }


            $this->sheet->setCellValueExplicit($columnIndex . $i, $columnVal, DataType::TYPE_STRING);
            $id++;
        }
    }

    protected function cellColor(string $cell, $color)
    {
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

    protected function listCellColor(array $cells, $color)
    {
        foreach ($cells as $cell) {
            $this->cellColor($cell, $color);
        }

    }

    protected function getLastCell()
    {
        return excel_column_name(count($this->attributes) - 1);
    }

    protected function isOutByteLimit($val, $byteLimit)
    {
        if (strlen($val) > $byteLimit) {
            return true;
        } else {
            return false;
        }
    }

    protected function isEmpty($val): bool
    {

        if (empty($val) || $val == '0,00') {

            return true;
        }
        return false;
    }

    protected function getByteLimit($columnIndex): ?int
    {
        $columnName = $this->attributesCell[$columnIndex];

        if (isset($this->limitBytes[$columnName])) {

            return $this->limitBytes[$columnName];
        }
        return null;
    }

    protected function isBulletPointOutOfLimit(): bool
    {
        $totalLength = 0;
        foreach ($this->bulletPointAttributes as $attribute) {
            if (property_exists($this->model, $attribute)) {
                $totalLength += strlen(preg_replace('/\s+/', ' ', $this->model->{$attribute}));
            }
        }

        $byteLimit = $this->limitBytes['bullet_point'];
        if ($totalLength > $byteLimit) {
            return false;
        } else {
            return false;
        }

    }

    protected function getNotEmpty($columnIndex): bool
    {
        $columnName = $this->attributesCell[$columnIndex];

        if (in_array($columnName, $this->notEmpty)) {

            return true;
        }
        return false;

    }

}