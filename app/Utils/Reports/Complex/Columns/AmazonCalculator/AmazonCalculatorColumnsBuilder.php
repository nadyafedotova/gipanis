<?php

namespace App\Utils\Reports\Complex\Columns\AmazonCalculator;

use App\Utils\Reports\Complex\AmazonCalculatorConfig;
use App\Utils\Reports\Complex\Columns\ArtikelColumns;
use App\Utils\Reports\Complex\Columns\Contract\ReportsColumnsBuilder;
use App\Utils\Reports\Complex\Contract\ReportsConfigContract;

class AmazonCalculatorColumnsBuilder implements ReportsColumnsBuilder
{

    protected $selectColumn;

    protected $reportColumn;

    /**
     * @var AmazonCalculatorConfig
     */
    protected $configContract;

    /**
     * @var ArtikelColumns
     */
    protected $artikelColumns;

    public function __construct(ReportsConfigContract $configContract)
    {
        $this->configContract = $configContract;
    }


    public function build()
    {

        $base = $this->artikelColumns();
        $join = $this->joinColumns();

        $params = compact('base', 'join');

        $this->setSelectQuery($params);
//        $this->setBlocks($params);

    }

    protected function setSelectQuery($params)
    {
        $columns = [];

        foreach ($params as $block) {
            foreach ($block['select'] as $column) {
                $columns = array_merge($columns, $column);

            }
        }

       $this->configContract->setColumns($columns);
    }

    protected function setBlocks($params)
    {
        $columns = [];
        foreach ($params as $nameBlock => $block) {
            if(!empty($block['header'])) {
                foreach ($block['select'] as $columnsByBlock) {
                    $columns[$nameBlock]= $columnsByBlock;
                }
            }

        }

        $this->configContract->setBlocks($columns);
    }

    protected function artikelColumns()
    {

        $tableConfig = $this->configContract->table();
        $artikelColumns = new ArtikelColumns($tableConfig['table'], $tableConfig['columns']);
        $columns['select'][$tableConfig['table']] = $artikelColumns->getSelect();
        $columns['header'][$tableConfig['table']] = $artikelColumns->getHeader();
        return $columns;
    }

    protected function joinColumns()
    {

        $columnsJoin['select'] = (new AmazonCalculatorColumns($this->configContract->joinTable()))->getSelect();
        $columnsJoin['header'] = (new AmazonCalculatorColumns($this->configContract->joinTable()))->getSelect();
        return $columnsJoin;
    }

}