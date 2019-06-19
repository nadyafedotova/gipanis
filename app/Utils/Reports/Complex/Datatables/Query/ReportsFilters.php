<?php

namespace App\Utils\Reports\Complex\Datatables\Query;

use App\Utils\Reports\Complex\Datatables\Contract\QueryFiltersContract;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class ReportsFilters  implements QueryFiltersContract
{
    /**
     *  ID, cHAN, kArtikel , cArtNr, cBarcode, EAN, ASIN , SKU, open_date, last_date_in  (sqlQuery)
     */
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Builder
     */
    protected $query;

    public function __construct(Request $request, Builder $query)
    {
        $this->request = $request;
        $this->query = $query;
    }

    public function make(): Builder
    {
        if (isset($this->request->input['filters'])) {
            $this->filterBuild();
        }
        return $this->query;

    }

    public function filterBuild()
    {
        foreach ($this->request->input['filters'] as $key => $value) {
            if(method_exists($this, $key.'Filter')) {
                $this->{$key.'Filter'}($value);
            }
        }
    }

    public function textFilter($value)
    {

    }
}