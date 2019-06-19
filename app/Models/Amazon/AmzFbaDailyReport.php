<?php

namespace App\Models\Amazon;

use App\Models\TableModel;
use App\Models\Traits\DataAttribute;

class AmzFbaDailyReport extends TableModel
{
    use DataAttribute;

    protected $table = 'amz_fba_daily_report';
}
