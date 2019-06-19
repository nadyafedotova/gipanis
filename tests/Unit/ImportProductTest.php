<?php

namespace Tests\Unit;

use App\Utils\AmazonImport\ImportProduct;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportProductTest extends TestCase
{
    /**
     * @var ImportProduct
     */
    protected $imporyProduct;

    protected function setUp()
    {
        parent::setUp();

        $this->imporyProduct = $this->app->make(ImportProduct::class);
    }

    /**
     * @test
     */
    public function is_file_exists()
    {
            $this->assertTrue(\Storage::exists($this->imporyProduct->fullPath()));
    }
}
