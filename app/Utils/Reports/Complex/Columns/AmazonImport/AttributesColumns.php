<?php
namespace App\Utils\Reports\Complex\Columns\AmazonImport;

use App\Repositories\JTL\JtlAttributRepository;
use App\Utils\AmazonImport\ImportProduct;
use App\Utils\Reports\Complex\Columns\Contract\ReportsColumns;

/**
 * Class AttributesColumns
 * @package App\Utils\Reports\Complex\Columns\AmazonImport
 */
class AttributesColumns implements ReportsColumns
{
    protected $amzImport;

    protected $attributes;

    protected $tableName;

    protected $repository;

   protected $prefix = 'attribute_';

    public function __construct(JtlAttributRepository $repository, $tableName, bool $amzImport = false)
    {

        $this->amzImport = $amzImport;

        $this->tableName = $tableName;

        $this->repository = $repository;

        $this->attributes = $this->getAttributes();
    }

    public function getSelect(int $lang = 1): array
    {
        $queryArr = [];

        for ($a = 0; $a < count($this->attributes); $a++) {
            $attribute = $this->attributes[$a];
            $queryArr[$this->prefix. $attribute->kAttribut] = "(SELECT IF( jtl_artikel_attribut_sprache.cWertVarchar IS NOT NULL, cWertVarchar, nWertInt) as attribut_value 
            FROM jtl_artikel_attribut_sprache WHERE jtl_artikel_attribut_sprache.kArtikelAttribut = 
            (SELECT DISTINCT kArtikelAttribut FROM jtl_artikel_attribut WHERE jtl_artikel_attribut.kArtikel= " . $this->tableName . ".kArtikel 
            AND kAttribut=" . $attribute->kAttribut . ") AND kSprache=" . $lang . ")  ";
        }

        return $queryArr;
    }

    public function getHeader(): array
    {
        $column = [];

        for ($a = 0; $a < count($this->attributes); $a++) {
            $attrbute = $this->attributes[$a];
            $column[$this->prefix. $attrbute->kAttribut] = $attrbute->cBeschreibung;
        }

        return $column;
    }

    protected function getAttributes()
    {
        if($this->amzImport) {
            $ids = (new ImportProduct())->getAttibutes();
        } else {
            $ids = null;
        }
        return $this->repository->attributesColumnX04($ids);
    }
}