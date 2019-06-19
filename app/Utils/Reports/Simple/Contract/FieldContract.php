<?php

namespace App\Utils\Reports\Simple;

interface FieldContract
{
    /**
     * @return array
     */
    public function builder(): array;

    /**
     * @return array
     */
    public function getColumns(): array;

    /**
     * @return array
     */
    public function getFilters(): array;

    /**
     * @return array
     */
    public function getSorts(): array;
}