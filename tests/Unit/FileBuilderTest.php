<?php

namespace Tests\Unit;

use App\Utils\DownloadReportsBuilder\Contract\FileBuilderContract;
use App\Utils\DownloadReportsBuilder\Exceptions\DownloadReportsBuilderException;
use App\Utils\DownloadReportsBuilder\Facade\FileBuilder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FileBuilderTest extends TestCase
{
    /** @test */
    public function get_builder()
    {
        $builder = FileBuilder::builder('X04', 'excel');

        $this->assertTrue($builder instanceof FileBuilderContract);
    }

    /**
     * @test
     * @expectedException \App\Utils\DownloadReportsBuilder\Exceptions\DownloadReportsBuilderException
     */
    public function get_exception()
    {
        $builder = FileBuilder::builder('XA05', 'excel');
    }
}
