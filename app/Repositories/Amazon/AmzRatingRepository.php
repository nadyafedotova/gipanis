<?php

namespace App\Repositories\Amazon;

use App\Models\Amazon\AmzRating;
use App\Repositories\BaseRepository;
use App\Utils\Reports\Complex\Datatables\Eloquent\AmzRatingFilters;

class AmzRatingRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return AmzRating::class;
    }

    public function search( array $filters )
    {
        $storeId =1;

        if(!empty($filters['store'])) {
            $storeId = $filters['store'];
        }
        $selects = [
            'amz_ratings.ASIN',
            'amz_ratings.store_id',
            'amz_ratings.rating',
            'amz_ratings.stars1',
            'amz_ratings.stars2',
            'amz_ratings.stars3',
            'amz_ratings.stars4',
            'amz_ratings.stars5',
            '(amz_ratings.stars1+amz_ratings.stars2+amz_ratings.stars3+amz_ratings.stars4+amz_ratings.stars5) as total',
            'c.venkon',
            'c.notVenkon',
            'h.prev_rating as prev_rating',
            'fba.sku as sku',
            'fba.afn_listing_exists as afn'
        ];

        $query = $this->model->selectRaw(
            implode(', ', $selects)
        )
            ->leftJoin(\DB::raw("(SELECT MAX(competitors.id) as id, venkon, notVenkon, asin FROM competitors WHERE competitors.store_id = $storeId
                GROUP BY competitors.asin) as c"), function ($join) {
                $join->on('amz_ratings.asin', '=', 'c.asin');
            })
            ->leftJoin(\DB::raw("(SELECT history_amz_ratings.asin, history_amz_ratings.rating prev_rating FROM history_amz_ratings
                LEFT JOIN (SELECT asin, MAX(DATE(created_at)) as lastDate
                FROM history_amz_ratings WHERE history_amz_ratings.store_id = ". $storeId."
                GROUP BY history_amz_ratings.asin) as h ON h.asin = history_amz_ratings.asin
                WHERE history_amz_ratings.store_id = $storeId AND DATE(history_amz_ratings.created_at) = lastDate) h
                 "), function ($join) {
                $join->on('amz_ratings.asin', '=', 'h.asin');
            })
            ->leftJoin(\DB::raw("(SELECT * FROM amz_fba_history
              WHERE amz_fba_history.store_id = $storeId
              GROUP BY amz_fba_history.asin) as fba"), function ($join) {
                $join->on('amz_ratings.asin', '=', 'fba.asin');
            });
        $data = app()->make(AmzRatingFilters::class, ['query' => $query])->make()->paginate(20);

        return $data;

    }
}