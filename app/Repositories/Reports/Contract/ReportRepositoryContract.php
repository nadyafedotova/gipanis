<?php

namespace App\Repositories\Reports\Complex\Contract;

/**
 * Interface RepositoryContract.
 */
interface ReportRepositoryContract
{

    public function datatable();

    public function codeReport();

    public function base();

    public function complex(array $parentsId);

    public function child(array $parentsId);

}
