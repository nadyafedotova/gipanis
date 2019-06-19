<?php

namespace Tests\Unit;

use App\Models\Amazon\AmzFbaDailyReport;
use App\Utils\Reports\Simple\TableFieldsBuilder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FiltersBuilderTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_get_table_model()
    {
        $entity = new AmzFbaDailyReport;
        $filters = app()->make(TableFieldsBuilder::class, ['model' => $entity])->getFilters();

        $this->assertTrue(in_array('fulfillment_center_id', $filters));
    }


}
