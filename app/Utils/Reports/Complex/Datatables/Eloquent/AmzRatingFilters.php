<?php

namespace App\Utils\Reports\Complex\Datatables\Eloquent;

use App\Utils\Reports\Complex\Datatables\Contract\AmzFilterContract;
use App\Utils\Reports\Complex\Datatables\Contract\EloquentFiltersContract;
use App\Utils\Reports\Simple\ReportsTableFieldsBuilder;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Http\Request;

class AmzRatingFilters implements EloquentFiltersContract, AmzFilterContract
{
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
        $request = $this->request->all();
        if (isset($request['filters'])) {
            $this->filterBuild();
        }
        return $this->query;

    }

    public function filterBuild()
    {
        $filters = json_decode($this->request->all()['filters'], true);
        foreach ($filters as $key => $value) {
            if(method_exists($this, $key.'Filter')) {
                $this->{$key.'Filter'}($value);
            }
        }
    }

    public function statusFilter($value)
    {

        switch($value) {
            case 1:
                $this->query->whereRaw('(SELECT count(asin) FROM amz_fba_history WHERE `afn_listing_exists` = \'Yes\' AND amz_fba_history.asin=amz_ratings.asin AND  amz_fba_history.store_id=amz_ratings.store_id) > 0');
                return ;
            case 2:
                $this->query->whereRaw('(SELECT count(asin) FROM amz_fba_history WHERE `afn_listing_exists` = \'\' AND amz_fba_history.asin=amz_ratings.asin AND  amz_fba_history.store_id=amz_ratings.store_id) > 0');
                return;
            default:
                return;
        }
    }

    public function growthFilter($value)
    {
        switch($value) {
            case 1:
                $this->query->where('prev_rating', '<', 'amz_ratings.rating');
                return ;
            case 2:
                $this->query->where('prev_rating', '>', 'amz_ratings.rating');
                return;
            default:
                return;
        }
    }

    public function ratingFilter($value)
    {
        switch($value) {
            case 1:
                $this->query->where('amz_ratings.rating', '>=', '3.8');
                return ;
            case 2:
                $this->query->whereBetween('amz_ratings.rating', ['3.4', '3.8']);
                return ;
            case 3:
                $this->query->whereBetween('amz_ratings.rating',  ['0.1', '3.4']);
                return;
            default:
                return;
        }
    }

    public function textFilter($value)
    {
        $fields = app()->make(ReportsTableFieldsBuilder::class, ['reportName' => 'rating'])->getFilters();
        $this->query->where(function ($query) use ($fields, $value) {
        foreach ($fields as $column) {
            $query->orWhere($column, 'like', $value);
        }
        });

    }

    public function storeFilter($value)
    {
        $this->query->where('amz_ratings.store_id',  $value);
    }
}