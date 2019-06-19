<?php

namespace Tests\Unit;

use App\Utils\Reports\Complex\AmazonImportConfig;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AmazonImportConfigTest extends TestCase
{
    /** @test */
    public function it_set_table()
    {
        $amzImportConfig = app()->make(AmazonImportConfig::class);
        $table = $amzImportConfig->table();
        $nameTable = key($table);
        $this->assertEquals('jtl_artikel', $nameTable);
    }

    /** @test */
    public function it_set_columns()
    {
        $amzImportConfig = app()->make(AmazonImportConfig::class);
        $this->assertNotEmpty($amzImportConfig->columns());
    }
}
