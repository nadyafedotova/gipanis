<?php

namespace App\Utils\Reports\Complex\Contract;

interface ReportsConfigContract
{
    public function table(): array;

    public function joinTable(): array;

    public function columns(): array;

    public function setColumns(array $columns);

    public function filters(): array;

    public function blocks(): array;

    public function setBlocks(array $blocks = []);

}