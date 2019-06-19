<?php
namespace App\Models\Contract;

interface TableModelContract
{
    /**
     * @return array
     */
    public function getFields(): array;
}