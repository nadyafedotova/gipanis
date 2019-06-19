<?php

namespace App\Repositories\Reports;

use App\Utils\Reports\Complex\AmazonImportConfig;
use App\Utils\Reports\Complex\Datatables\Query\AmazonImportBuildQuery;
use App\Utils\Reports\Complex\Datatables\Query\AmazonImportFilters;

class AmazonImportRepository extends BaseReportRepository
{

    /**
     * AmazonImportRepository constructor.
     * @param AmazonImportConfig $reportsConfig
     */
    public function __construct(AmazonImportConfig $reportsConfig)
    {
        parent::__construct($reportsConfig);
    }

    /**
     * @return string
     */
    public function codeReport()
    {
        return 'X04';
    }


    protected function setReportBuildQuery()
    {
        $this->reportBuildQuery = AmazonImportBuildQuery::class;
    }

    protected function setReportFiltersQuery()
    {
        $this->reportFiltersQuery = AmazonImportFilters::class;
    }


}