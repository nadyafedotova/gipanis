<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportsScheduleCommandTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testConsoleCommand()
    {
        $this->artisan('db:seed', ['--class'=>'ReportsConfigSeeder']);
        $this->artisan('report:schedule-rewrite')
            ->expectsOutput('Table with old format exist!')
            ->assertExitCode(0);
    }
}
