<?php

namespace App\Utils\Reports\Complex\Columns\Contract;

use App\Utils\Reports\Complex\Contract\ReportsConfigContract;
use Illuminate\Broadcasting\PendingBroadcast;

interface ReportsColumnsBuilder
{

    public function build();

}