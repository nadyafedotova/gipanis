<?php

namespace Tests\Unit;

use App\Utils\Reports\Complex\Datatables\Query\AmazonImportBuildQuery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AmazonImportBuildQueryTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function show_sql()
    {
        \DB::connection()->enableQueryLog();
        $amazonImportBuildQuery = app()->make(AmazonImportBuildQuery::class);
        $query = $amazonImportBuildQuery->build();
        $query->get();
        dd(\DB::getQueryLog());
        $this->assertTrue(true);
    }
}
