<?php

namespace App\Utils\Reports\Complex\Datatables\Query;

use App\Models\Jtl\JtlArtikelBeschreibung;
use App\Models\Jtl\JtlHersteller;
use App\Repositories\JTL\JtlAttributRepository;
use App\Repositories\JTL\JtlMerkmalSpracheRepository;
use App\Utils\Reports\Complex\AmazonImportConfig;
use App\Utils\Reports\Complex\Contract\ReportsConfigContract;
use App\Utils\Reports\Complex\Datatables\Contract\ReportsBuildQuery;
use Illuminate\Database\Query\Builder;

class AmazonImportBuildQuery implements ReportsBuildQuery
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
        $this->joinHersteller($query);
        $this->joinArtikelBeschreibung($query);

        return $query;

    }

    public function base(): Builder
    {
        $query = $this->all();
        $query->addSelect('stuecklistes.kStuecklistes as kStuecklistes')
            ->addSelect(\DB::raw('\'\' Artikeltyp'))
         ->leftJoin(\DB::raw("(
	        SELECT CONCAT('[',GROUP_CONCAT(JSON_OBJECT('kStueckliste', kStueckliste)), ']') kStuecklistes, kArtikel FROM jtl_tStueckliste  GROUP BY jtl_tStueckliste.kArtikel 
        ) stuecklistes"), function($join)
        {
            $join->on('stuecklistes.kArtikel', '=', $this->tableConfig['table'].'.kArtikel');
        });
        return $query
            ->where('kStueckliste', 0)
            ->where('kVaterArtikel', 0)
            ->where('cAktiv', 'Y');
    }

    public function complex(array $parentsId): Builder
    {
        return $this->all()
            ->addSelect($this->tableConfig['table'].'.kStueckliste')
            ->addSelect(\DB::raw('\'Stuecklistenartikel\' Artikeltyp'))
            ->whereRaw(
                'kStueckliste IN (SELECT kStueckliste FROM jtl_tStueckliste  as t1 WHERE  t1.kArtikel IN ('.str_repeat('?,',(count($parentsId))-1).'?))',
                $parentsId
            );
    }

    public function child(array $parentsId): Builder
    {
        return $this->all()
            ->addSelect($this->tableConfig['table'].'.kVaterArtikel')
            ->addSelect(\DB::raw('\'Child\'  Artikeltyp'))
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


    protected function joinHersteller($query)
    {
        $tableName = (new JtlHersteller())->getTable();
        $tableConfig = $this->joinTableConfig[$tableName];

        $query->leftJoin($tableName , $this->tableConfig['table'] . '.KHersteller', '=', $tableName . '.KHersteller');
    }

    protected function joinArtikelBeschreibung($query)
    {
        $tableName = (new JtlArtikelBeschreibung())->getTable();
        $tableConfig = $this->joinTableConfig[$tableName];
        $artikelBeschreibungQuery = \DB::table($tableName )
            ->where($tableName . '.kPlattform', 50)
            ->where($tableName . '.kSprache', 1);


        $query->leftJoinSub($artikelBeschreibungQuery, $tableConfig['alias'], function ($join) use ($tableConfig) {
            $join->on($this->tableConfig['alias'] . '.kArtikel', '=', $tableConfig['alias'] . '.kArtikel');
        });
    }
}