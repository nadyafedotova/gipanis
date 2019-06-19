<?php

namespace App\Utils\Reports\Complex;

use App\Models\Amazon\AmzFbaReserved;
use App\Models\Amazon\AmzRating;
use App\Models\Jtl\JtlArtikel;
use App\Models\Jtl\JtlLagerbestand;
use App\Models\JtlAmzConcatArtikel;
use App\Utils\Reports\Complex\Columns\AmazonCalculator\AmazonCalculatorColumnsBuilder;
use App\Utils\Reports\Complex\Contract\ReportsConfigContract;
use App\Utils\Reports\Complex\Datatables\FilterSettings\ValuesBuilder;

class AmazonCalculatorConfig implements ReportsConfigContract
{
    /**
     * @var AmazonCalculatorColumnsBuilder
     */
    protected $columnsBuilder;

    protected $columns = [];

    protected $blocks = [
        'base' => [
            'ID' => 'ID',
            'cHAN' => 'cHAN',
            'cArtNr' => 'cArtNr',
            'Artikeltyp' => 'Artikeltyp',
            'EndOFLife' => 'End of life',
            'AMALogik' => 'AMA-Logik',
            'kArtikel' => 'kArtikel',
            'cBarcode' => 'cBarcode',
            'EAN' => 'EAN',
            'ASIN' => 'ASIN',
        ],

        'rating' => [
            'rating' => 'Average stars',
            'total_number_reviews' => 'Total number reviews',
        ],

        'sales' => [
            'MFNSales' => 'MFN Sales',
            'AFNSales' => 'AFN Sales',
            'MFNTotalSales' => 'MFN Total Sales',
            'AFNTotalSales' => 'AFN Total Sales',

        ],

        'in_stock' => [
            'FVerfuegbar' => 'FVerfuegbar',
            'JTLInStockDays' => 'MFN Count Days InStock',
            'afn_fulfillable_quantity' => 'afn_fulfillable_quantity',
            'afn_reserved_quantity' => 'afn_reserved_quantity',
            'reserved_fc_transfers' => 'reserved_fc_transfers',
            'reserved_fc_processing' => 'reserved_fc_processing',
            'reserved_customerorders' => 'reserved_customerorders',
            'afn_inbound_working_quantity' => 'afn_inbound_working_quantity',
            'afn_inbound_shipped_quantity' => 'afn_inbound_shipped_quantity',
            'afn_inbound_receiving_quantity' => 'afn_inbound_receiving_quantity',
            'AFNQuantity' => 'Calculated AFN Stock Avalible',
            'AMZInStockDays' => 'AFN Count Days InStock'
        ],

        'calculator' => [
            'demandMFN' => 'Calculated Demand MFN',
            'demandMFNParent' => 'Calculated Demand MFN Parent',
            'demandAFN' => 'Calculated Demand AFN',
            'demandAFNParent' => 'Calculated Demand AFN Parent',
            'totalDemandSingle' => 'Total Demand Single',
            'afnStockNeeded' => 'AFN Stock needed',
            'afnStockNeededParent' => 'AFN Stock needed Parent',
            'availableForAFN' => 'Available for AFN',
        ],
        'send_to_amz' => [
            'send_to_amz' => 'Send to Amazon'
        ]
    ];

    public function table(): array
    {
        $table = (new JtlAmzConcatArtikel())->getTable();
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
                'cAktiv',
                'EndOFLife',
                'AMALogik',
                'EAN',
                'ASIN',
            ]
        ];
    }

    public function joinTable(): array
    {
        $lagerBestanTable = (new JtlLagerbestand())->getTable();
        //                LEFT JOIN amz_fba_reserved ON amz_fba_reserved.asin=amz_fba_history.asin

        $amzFbaReserved = (new AmzFbaReserved())->getTable();
        $amzFbaHistory = (new AmzFbaReserved())->getTable();
        $amzRatings = (new AmzRating())->getTable();
        return [
            $lagerBestanTable => [
                'alias' => $lagerBestanTable,
                'columns' => [
                    '',
                ]
            ],
            $amzFbaReserved => [
                'alias' => 'afn_quantity',
                'columns' => [
                    'reserved_fc_transfers',
                    'reserved_fc_processing',
                    'reserved_customerorders',

                ]
            ],
            $amzFbaHistory => [
                'alias' => 'afn_quantity',
                'columns' => [
                    'asin',
                    'sku',
                    'afn_reserved_quantity',
                    'afn_fulfillable_quantity',
                    'afn_inbound_receiving_quantity',
                    'afn_inbound_working_quantity',
                    'afn_inbound_shipped_quantity'

                ]
            ],
            $amzRatings => [
                'alias' => 'ratings',
                'columns' => [
                    'asin',
                    'rating',
                    'stars1',
                    'stars2',
                    'stars3',
                    'stars4',
                    'stars5'
                ]
            ]
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
        $values = (new ValuesBuilder())->make([]);
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




    protected function columnsBuilder()
    {
        $columnBuilder = new AmazonCalculatorColumnsBuilder($this);
        return $columnBuilder->build();
    }

}