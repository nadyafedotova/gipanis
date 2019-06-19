<?php

namespace App\Utils\Reports\Complex\Datatables\Contract;


use Illuminate\Database\Query\Builder;

interface QueryFiltersContract extends FiltersContract
{
    public function make(): Builder;

}