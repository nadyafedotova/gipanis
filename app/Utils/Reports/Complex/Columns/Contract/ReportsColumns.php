<?php
namespace App\Utils\Reports\Complex\Columns\Contract;

interface ReportsColumns
{

    /**
     * @return array
     */
    public function getSelect(): array;

    public function getHeader(): array;
}