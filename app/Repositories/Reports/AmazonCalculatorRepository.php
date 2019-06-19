<?php

namespace App\Repositories\Reports;



use App\Utils\Reports\Complex\AmazonCalculatorConfig;
use App\Utils\Reports\Complex\Contract\ReportsConfigContract;
use App\Utils\Reports\Complex\Datatables\Query\AmazonCalculatorBuildQuery;
use App\Utils\Reports\Complex\Datatables\Query\AmazonCalculatorFilters;

class AmazonCalculatorRepository extends BaseReportRepository
{
    /**
     * AmazonImportRepository constructor.
     * @param AmazonCalculatorConfig $reportsConfig
     */
    public function __construct(AmazonCalculatorConfig $reportsConfig)
    {
        parent::__construct($reportsConfig);
    }


    public function codeReport()
    {
        return 'X09';
    }

    public function getForCalculate()
    {

        $data = \DB::select("SELECT 
	jtl_amz_concat_artikel.kArtikel, 
	jtl_amz_concat_artikel.cArtNr, 
	jtl_amz_concat_artikel.ASIN, 
	jtl_amz_concat_artikel.AMALogik, 
	jtl_amz_concat_artikel.MFNSales,
	jtl_amz_concat_artikel.AFNSales,
	jtl_amz_concat_artikel.MFNTotalSales,
	jtl_amz_concat_artikel.AFNTotalSales,
	jtl_amz_concat_artikel.AMZInStockDays,
	jtl_amz_concat_artikel.kType,
	jtl_lagerbestand.FVerfuegbar,
	IFNULL(AFNQuantity,0) AFNQuantity,
	stueckliste_child
FROM jtl_amz_concat_artikel
LEFT JOIN jtl_lagerbestand ON jtl_lagerbestand.kArtikel=jtl_amz_concat_artikel.kArtikel
LEFT JOIN( 
SELECT 
amz_fba_history.sku, 
(IFNULL(afn_fulfillable_quantity, 0)+IFNULL(reserved_fc_transfers, 0)+IFNULL(reserved_fc_processing, 0)) AFNQuantity
FROM amz_fba_history
LEFT JOIN amz_fba_reserved ON amz_fba_reserved.asin=amz_fba_history.asin
) amz_quantity ON amz_quantity.sku=jtl_amz_concat_artikel.cArtNr
LEFT JOIN jtl_artikel ON jtl_artikel.kArtikel=jtl_amz_concat_artikel.kArtikel
LEFT JOIN (
	SELECT jtl_tStueckliste.kStueckliste, CONCAT('[',GROUP_CONCAT(JSON_OBJECT(\"kArtikel\", kArtikel, \"fAnzahl\", fAnzahl)), ']') as stueckliste_child
	FROM jtl_tStueckliste 
	GROUP BY kStueckliste
) stuckliste ON stuckliste.kStueckliste=jtl_artikel.kStueckliste
ORDER BY AFNSales DESC");
        return $data;
    }

    protected function setReportBuildQuery()
    {
        $this->reportBuildQuery = AmazonCalculatorBuildQuery::class;
    }

    protected function setReportFiltersQuery()
    {
        $this->reportFiltersQuery = AmazonCalculatorFilters::class;
    }

}