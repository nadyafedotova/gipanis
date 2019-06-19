<?php

namespace App\Utils\Reports\Complex\Columns;


use App\Utils\Reports\Complex\Columns\Contract\ReportsColumns;

class AmazonImportColumns implements ReportsColumns
{

    protected $joinTables;

    public function __construct(array $joinTables)
    {
        $this->joinTables = $joinTables;
    }

    public function getSelect(): array
    {
        $build = [];
        foreach ($this->joinTables as $table => $config) {
            if (empty($config['columns'])) {
                break;
            }
            $columns = $config['columns'];
            for ($i = 0; $i < count($columns); $i++) {
                $column = $columns[$i];
                if (method_exists($this, "get" . ucfirst($column))) {
                    $build[$table][$column] = $this->{"get" . $column}($table);
                } else {
                    $build[$table][$column] = $this->basePattern($table, $column);
                }
            }
        }

        return $build;
    }

    public function getHeader(): array
    {
        return [];
    }

    protected function getHersteller($table)
    {
        return $table . '.`cName`';
    }

    protected function basePattern($table, $columnName)
    {
        return $table . '.`' . $columnName . '`';
    }

}