<?php

namespace App\Utils\Reports\Complex\Columns\AmazonImport;


use App\Repositories\JTL\JtlMerkmalSpracheRepository;
use App\Utils\AmazonImport\ImportProduct;
use App\Utils\Reports\Complex\Columns\Contract\ReportsColumns;

class MerkalColumns implements ReportsColumns
{
    protected $amzImport;

    protected $merkmal;

    protected $tableName;

    protected $repository;

    protected $prefix = 'merkal_';

    public function __construct(JtlMerkmalSpracheRepository $repository, $tableName, bool $amzImport = false)
    {

        $this->amzImport = $amzImport;

        $this->tableName = $tableName;

        $this->repository = $repository;

        $this->merkmal = $this->getAttributes();
    }

    public function getSelect(int $lang = 1): array
    {
        $queryArr = [];

        for ($a = 0; $a < count($this->merkmal); $a++) {
            $merkmal = $this->merkmal[$a];
            $queryArr[$this->prefix.$merkmal->kMerkmal] = "(SELECT GROUP_CONCAT(jtl_merkmal_wert_sprache.cWert) merkmal_values 
            FROM jtl_merkmal_wert_sprache WHERE jtl_merkmal_wert_sprache.kMerkmalWert IN
            (SELECT DISTINCT kMerkmalWert FROM jtl_artikel_merkmal WHERE jtl_artikel_merkmal.kArtikel= " . $this->tableName . ".kArtikel 
            AND kMerkmal=" . $merkmal->kMerkmal . ") AND kSprache=".$lang.") ";
        }

        return $queryArr;
    }

    public function getHeader(): array
    {
        $column = [];

        for ($a = 0; $a < count($this->merkmal); $a++) {
            $merkmal = $this->merkmal[$a];
            $column[$this->prefix. $merkmal->kMerkmal] = $merkmal->cName;
        }

        return $column;
    }

    protected function getAttributes()
    {
        if($this->amzImport) {
            $ids = (new ImportProduct())->getMerkal();
        } else {
            $ids = null;
        }
        return $this->repository->merkmalsColumnX04($ids);
    }
}