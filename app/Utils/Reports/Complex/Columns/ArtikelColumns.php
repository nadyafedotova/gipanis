<?php

namespace App\Utils\Reports\Complex\Columns;

use App\Models\Jtl\JtlArtikel;
use App\Utils\Reports\Complex\Columns\Contract\ReportsColumns;

class ArtikelColumns implements ReportsColumns
{
    /**
     * @var array
     */
    protected $columns;

    /**
     * @var string
     */
    protected $table;

    public function __construct(string $table = null, array $columns)
    {
        $this->table = $table;
        if (empty($this->table)) {
            $this->table = (new JtlArtikel)->getTable();
        }
        $this->columns = $columns;
    }

    public function getSelect(): array
    {
        $build = [];
        for ($i = 0; $i < count($this->columns); $i++) {
            $column = $this->columns[$i];
            if (method_exists($this, "get" . $column)) {
                $build[$column] = $this->{"get" . $column}();
            } else {
                $build[$column] = $this->getDefault($column);
            }
        }
        return $build;
    }

    public function getHeader(): array
    {
        return [];
    }

    public function getID(): string
    {
        return 'SUBSTRING(' . $this->table . '.cArtNr, 1,5)';
    }

    public function getDefault($columnName): string
    {
        $model = new JtlArtikel();
        $columns = $model->getFields();

        if (in_array($columnName, $columns)) {
            return $this->basePattern($columnName);
        }

        return '';
    }

    protected function basePattern($columnName)
    {
        return $this->table . '.`' . $columnName . '`';
    }


}