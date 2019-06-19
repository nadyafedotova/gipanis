<?php

namespace App\Utils\Reports\Complex\Datatables\Contract;


use Illuminate\Database\Eloquent\Builder;

interface EloquentFiltersContract extends FiltersContract
{
    public function make(): Builder;

}