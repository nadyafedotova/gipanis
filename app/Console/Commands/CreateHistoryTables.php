<?php

namespace App\Console\Commands;

use App\Repositories\ReportsConfigRepository;
use Illuminate\Console\Command;

class CreateHistoryTables extends Command
{

    protected $reportsConfigRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'history-table:create {table?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create table ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ReportsConfigRepository $reportsConfigRepository)
    {
        $this->reportsConfigRepository = $reportsConfigRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if($this->argument('table')) {
            $tables = [$this->argument('table')];
        } else {
            $tables = $this->reportsConfigRepository->listHistoryTables();
        }
    }
}
