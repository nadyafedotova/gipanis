<?php

namespace App\Utils\Reports\Complex\Datatables\Contract;

use Illuminate\Database\Query\Builder;

interface ReportsBuildQuery
{

    public function all(): Builder;

    public function base(): Builder;

    public function complex(array $parentsId): Builder;

    public function child(array $parentsId): Builder;
}