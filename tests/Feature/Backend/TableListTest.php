<?php

namespace Tests\Feature\Backend;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TableListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function the_table_list_route_exists()
    {
        $this->get('/table/a01')->assertStatus(302);
    }

    /**
     * @test
     */
    public function admin_can_access_to_tableList_route()
    {
        $this->loginAsAdmin();
        $this->get('/table/a01')->assertStatus(200);
    }
}
