<?php

namespace App\Models\Amazon;

use App\Models\TableModel;

class AmzRating extends TableModel
{
    protected $table = 'amz_ratings';

    /**
     * @return mixed
     */
    public function history()
    {
        return $this->hasMany(H::class, 'asin', 'asin')
            ->where('history.store_id', 'rating.store_id');
    }
}
