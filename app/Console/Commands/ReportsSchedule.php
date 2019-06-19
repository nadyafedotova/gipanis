<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Console\Commands\Traits\ReportsAttributes;

class ReportsSchedule extends Command
{
    use ReportsAttributes;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:schedule-rewrite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rewrite old format schedule serialised array to json for table "reports_configs"';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $table = 'reports_configs';
        if (!Schema::hasTable('reports_config')) {
            $this->error('Table with old format not found!');
        } else {
            $this->info('Table with old format exist!');
            $oldformat = DB::select('select * from reports_config');

            foreach ($oldformat as $item) {

                $new = DB::table($table)->where('code', $item->code)->first();
                if(!is_null($new)) {
                    if(!is_null($this->getEntityByCode($item->code))) {
                        DB::table($table)
                            ->where('code', $item->code)
                            ->update(['entity' => $this->getEntityByCode($item->code)]);
                    }
                    continue;
                }

                $data = (array)$item;
                $data['entity'] = $this->getEntityByCode($item->code);
                if(!is_null($data['schedules'])) {
                    $data['schedules'] = json_encode(unserialize($data['schedules']));
                }
                if(!is_null($data['schedules_history'])) {
                    $data['schedules_history'] = json_encode(unserialize($data['schedules_history']));
                }
                DB::table($table)->insert($data);
            }

        }


    }
}
