<?php

namespace App\Utils\Reports\Complex\Columns\AmazonCalculator;


use App\Utils\Reports\Complex\Columns\Contract\ReportsColumns;

class AmazonCalculatorColumns implements ReportsColumns
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
                    $build[$config['alias']][$column] = $this->{"get" . $column}($table);
                } else {
                    $build[$config['alias']][$column] = $this->basePattern($table, $column);
                }
            }
        }

        return $build;
    }

    public function getHeader(): array
    {
        return [];
    }


    protected function basePattern($table, $columnName)
    {
        return $table . '.`' . $columnName . '`';
    }

}