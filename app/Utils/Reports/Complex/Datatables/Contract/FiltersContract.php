<?php

namespace App\Utils\Reports\Complex\Datatables\Contract;

interface FiltersContract
{

    public function make();

    public function textFilter($value);

}