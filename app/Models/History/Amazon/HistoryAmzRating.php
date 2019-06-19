<?php

namespace App\History\Amazon;

use App\Models\Amazon\AmzRating;
use Illuminate\Database\Eloquent\Model;

class HistoryAmzRating extends Model
{
    protected $table = 'history_amz_ratings';

    public function history()
    {
        return $this->hasMany( AmzRating::class, 'asin', 'asin')
            ->where('history.store_id', 'rating.store_id');
    }
}
