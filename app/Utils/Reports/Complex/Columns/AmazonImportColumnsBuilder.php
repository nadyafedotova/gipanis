<?php

namespace App\Utils\Reports\Complex\Columns;

use App\Utils\Reports\Complex\AmazonImportConfig;
use App\Utils\Reports\Complex\Columns\AmazonImport\AttributesColumns;
use App\Utils\Reports\Complex\Columns\AmazonImport\CustomAttributesColumns;
use App\Utils\Reports\Complex\Columns\AmazonImport\MerkalColumns;
use App\Utils\Reports\Complex\Columns\Contract\ReportsColumnsBuilder;
use App\Utils\Reports\Complex\Contract\ReportsConfigContract;

class AmazonImportColumnsBuilder implements ReportsColumnsBuilder
{

    protected $selectColumn;

    protected $reportColumn;

    /**
     * @var AmazonImportConfig
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
        $attributes = $this->attributesColumns();
        $custom_attributes = $this->customAttributesColumns();
        $merkal = $this->merkalColumns();

        $params = compact('base', 'join', 'attributes', 'custom_attributes', 'merkal');

        $this->setSelectQuery($params);
        $this->setBlocks($params);

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
                foreach ($block['header'] as $columnsByBlock) {
                    if(!empty($columnsByBlock)) {
                        $columns[$nameBlock]= $columnsByBlock;
                    }

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

        $columnsJoin['select'] = (new AmazonImportColumns($this->configContract->joinTable()))->getSelect();
        $columnsJoin['header'] = (new AmazonImportColumns($this->configContract->joinTable()))->getHeader();
        return $columnsJoin;
    }

    protected function attributesColumns()
    {
        $attributesColumn = app()->make(AttributesColumns::class, [
            'tableName' => $this->configContract->table()['table'],
            'amzImport' => $this->configContract->isAmzImport()
        ]);
        $columns['select']['attributes'] = $attributesColumn->getSelect();
        $columns['header']['attributes'] = $attributesColumn->getHeader();
        return $columns;
    }

    protected function customAttributesColumns()
    {
        $attributesColumn = app()->make(CustomAttributesColumns::class, [
            'tableName' => $this->configContract->table()['table'],
            'amzImport' => $this->configContract->isAmzImport()
        ]);
        $columns['select']['custom_attributes'] = $attributesColumn->getSelect();
        $columns['header']['custom_attributes'] = $attributesColumn->getHeader();
        return $columns;
    }


    protected function merkalColumns()
    {
        $attributesColumn = app()->make(MerkalColumns::class, [
            'tableName' => $this->configContract->table()['table'],
            'amzImport' => $this->configContract->isAmzImport()
        ]);
        $columns['select']['merkal'] = $attributesColumn->getSelect();
        $columns['header']['merkal'] = $attributesColumn->getHeader();
        return $columns;
    }


}