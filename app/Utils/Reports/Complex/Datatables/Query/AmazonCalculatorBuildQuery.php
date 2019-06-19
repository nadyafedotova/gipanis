<?php

namespace App\Utils\Reports\Complex\Datatables\Query;

use App\Models\Amazon\AmzFbaHistory;
use App\Models\Amazon\AmzFbaReserved;
use App\Models\Amazon\AmzRating;
use App\Models\Jtl\JtlArtikelBeschreibung;
use App\Models\Jtl\JtlHersteller;
use App\Models\Jtl\JtlLagerbestand;
use App\Repositories\JTL\JtlAttributRepository;
use App\Repositories\JTL\JtlMerkmalSpracheRepository;
use App\Utils\Reports\Complex\AmazonImportConfig;
use App\Utils\Reports\Complex\Columns\AmazonCalculator\AmazonCalculatorColumns;
use App\Utils\Reports\Complex\Contract\ReportsConfigContract;
use App\Utils\Reports\Complex\Datatables\Contract\ReportsBuildQuery;
use Illuminate\Database\Query\Builder;

class AmazonCalculatorBuildQuery implements ReportsBuildQuery
{
    /**
     * @var AmazonImportConfig
     */
    protected $reportConfig;

    protected $tableConfig;

    protected $joinTableConfig;

    public function __construct(ReportsConfigContract $reportConfig)
    {
        $this->reportConfig = $reportConfig;

        $this->tableConfig = $this->reportConfig->table();

        $this->joinTableConfig = $this->reportConfig->joinTable();
    }

    public function all(): Builder
    {

        $query = \DB::table($this->tableConfig['table'])
            ->selectRaw(\DB::raw($this->select()));
        $this->joinAFNquantity($query);
        $this->joinRating($query);

        return $query;

    }

    public function base(): Builder
    {
        return $this->all()
            ->where('kType', 'h');
    }

    public function complex(array $parentsId): Builder
    {

        return $this->all()
            ->whereRaw(
                'kArtikel IN (
                        SELECT kArtikel FROM jtl_artikel WHERE jtl_artikel.kStueckliste IN( 
                        SELECT kStueckliste FROM jtl_tStueckliste WHERE jtl_tStueckliste.kArtikel IN ('.str_repeat('?,',count($parentsId)-1).'?)))',
                $parentsId
            );
    }

    public function child(array $parentsId): Builder
    {
        return $this->all()
            ->whereIn('kVaterArtikel', $parentsId);
    }

    protected function select(): string
    {
        $columnsConfig = $this->reportConfig->columns();

        $select = '*';
        if (!empty($columnsConfig)) {
            $select = '';
            foreach ($columnsConfig as $key => $column) {
                    $select .= (empty($select) ? '' : ', ') . $column . ' ' . $key;
            }
        }

        return $select;
    }


    protected function joinAFNquantity($query)
    {

        $tableNameReserved = (new AmzFbaReserved())->getTable();
        $tableNameHistory = (new AmzFbaHistory())->getTable();
        $tableConfigReserved = $this->joinTableConfig[$tableNameReserved];

        $subLeftJoin = \DB::table($tableNameHistory )
            ->selectRaw($tableNameHistory.'.asin,'.
        $tableNameHistory.'.sku,
        afn_reserved_quantity,
        reserved_fc_transfers,
        reserved_fc_processing,
        reserved_customerorders,
        afn_fulfillable_quantity,
        afn_inbound_receiving_quantity,
        afn_inbound_working_quantity,
        afn_inbound_shipped_quantity')
            ->leftJoin($tableNameReserved , $tableNameReserved. '.asin', '=', $tableNameHistory . '.asin');

         $query->leftJoinSub($subLeftJoin, $tableConfigReserved['alias'], function ($join) use ($tableConfigReserved) {
            $join->on($this->tableConfig['alias'] . '.asin', '=', $tableConfigReserved['alias'] . '.asin');
        });
    }

    protected function joinRating($query)
    {
        $tableName = (new AmzRating())->getTable();
        $tableConfig = $this->joinTableConfig[$tableName];
        $subQuery = \DB::table($tableName )
            ->selectRaw(
                $tableName.'.asin,'.
                $tableName.'.rating,'.
                $tableName.'.stars1,'.
                $tableName.'.stars2,'.
                $tableName.'.stars3,'.
                $tableName.'.stars4,'.
                $tableName.'.stars5'
            )
            ->whereRaw(  'created_at =(SELECT MAX(created_at) FROM '.$tableName.' AS r
                WHERE r.ASIN='.$tableName.'.ASIN AND store_id=1)')
            ->where($tableName . '.store_id', 1);


         $query->leftJoinSub($subQuery, $tableConfig['alias'], function ($join) use ($tableConfig) {
            $join->on($this->tableConfig['alias'] . '.asin', '=', $tableConfig['alias'] . '.asin');
        });
    }
}