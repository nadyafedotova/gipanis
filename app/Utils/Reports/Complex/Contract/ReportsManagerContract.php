<?php

namespace App\Utils\Reports\Complex\Contract;


interface ReportsManagerContract
{

    public function manage(string $configName);

    public function getConfig(): ReportsConfigContract;
}