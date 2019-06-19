<?php

namespace Tests\Unit;

use App\Models\Jtl\JtlAttribut;
use App\Repositories\JTL\JtlArtikelBeschreibungRepository;
use App\Repositories\JTL\JtlAttributRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JtlAttributRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_get_attributes_x04()
    {
        factory(JtlAttribut::class)->create();
        $repository = app()->make(JtlAttributRepository::class);
        $columns = $repository->attributesColumnX04();
        $this->assertTrue(is_object($columns));
    }
}
