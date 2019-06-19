<?php

namespace App\Utils\Reports\Complex;

use App\Models\Jtl\JtlArtikel;
use App\Models\Jtl\JtlArtikelBeschreibung;
use App\Models\Jtl\JtlHersteller;
use App\Utils\Reports\Complex\Columns\AmazonImportColumnsBuilder;
use App\Utils\Reports\Complex\Contract\ReportsConfigContract;
use App\Utils\Reports\Complex\Datatables\FilterSettings\ValuesBuilder;

class AmazonImportConfig implements ReportsConfigContract
{
    public function __construct(array $option = [])
    {
        if(isset($option['amzImport'])) {
            $this->setAmzImport($option['amzImport']);
        }

        $this->columnsBuilder();
    }

    /**
     * @var bool
     */
    protected $amzImport = false;

    /**
     * @var AmazonImportColumnsBuilder
     */
    protected $columnsBuilder;

    protected $columns = [];

    protected $blocks = [
        'base' => [
            'ID' => 'ID',
            'cHAN' => 'cHAN',
            'kArtikel' => 'kArtikel',
            'cArtNr' => 'cArtNr',
            'cBarcode' => 'cBarcode',
            'hersteller' => 'Hersteller',
            'cName' => 'cName',
            'fAmazonVK' => 'fAmazonVK'
        ],

        'attributes' => [

        ],

        'custom_attributes' => [

        ],

        'merkal' => [

        ]
    ];


    /**
     * @return array
     */
    public function table(): array
    {
        $table = (new JtlArtikel())->getTable();
        return [
            'table' => $table,
            'alias' => $table,
            'columns' => [
                'ID',
                'cHAN',
                'cArtNr',
                'kArtikel',
                'cBarcode',
                'fAmazonVK',
                'kVaterArtikel',
                'cAktiv'
            ]
        ];
    }

    public function joinTable(): array
    {
        $herstellerTable = (new JtlHersteller())->getTable();
        $jtlArtikelBeschreibungTable = (new JtlArtikelBeschreibung())->getTable();
        return [
            $herstellerTable => [
                'alias' => $herstellerTable,
                'columns' => [
                    'hersteller',
                ]
            ],
            $jtlArtikelBeschreibungTable => [
                'alias' => $jtlArtikelBeschreibungTable,
                'columns' => [
                    'cName',
                    'cBeschreibung'
                ]
            ],
        ];
    }

    /**
     * @return array
     */
    public function columns(): array
    {

        return $this->columns;
    }

    /**
     * @param array $columns
     */
    public function setColumns(array $columns) {
        $this->columns = $columns;
    }


    /**
     * @return array
     */
    public function filters(): array
    {
        $values = (new ValuesBuilder)->make([]);
        $filters = [];
        foreach ($this->blocks['base'] as $key => $name) {
            $filters[] = [
                'name' => $key,
                'label' => $name,
                'type' => 'text',
                'values' => $values,
                'value' => '',
            ];
        }

        return $filters;
    }

    /**
     * @param array $blocks
     * @return array
     */
    public function blocks(array $blocks = []): array
    {
        return $this->blocks;
    }

    /**
     * @param array $blocks
     */
    public function setBlocks(array $blocks = [])
    {
        if(!empty($blocks)) {
            $this->blocks = array_merge($this->blocks, $blocks);
        }
    }

    /**
     * @return bool
     */
    public function isAmzImport(): bool
    {
        return $this->amzImport;
    }
    /**
     * @param bool $amzImport
     */
    public function setAmzImport(bool $amzImport)
    {
        $this->amzImport = $amzImport;
    }


    protected function columnsBuilder()
    {
        $columnBuilder = new AmazonImportColumnsBuilder($this);
        return $columnBuilder->build();
    }

}