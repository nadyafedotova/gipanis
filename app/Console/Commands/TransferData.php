<?php

namespace App\Console\Commands;

use App\Repositories\Amazon\AmzSettingsRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use App\Utils\TransferDb;


class TransferData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transfer:add {table?} {--ignoreId=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Transfer of data from one table / database to another';
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
        $table = $this->argument('table');// посмотри как получить атрибут в ларе
        $ignoreId = $this->option('ignoreId');// посмотри как получить атрибут в ларе
        $oldTable = $table;
        if($table == 'amz_ratings') {
            $oldTable = 'ratings';
        }
        if(is_null($table)) {
            $this->error("Argument 'table' can't be empty");
            exit();
        }
        if (!Schema::hasTable($table)) {
            $this->error('Table not exists!');
        } else {
            new TransferDb();
            $mysql = \DB::connection('mysql');

            $mysql->table($table)->delete();
            $data = \DB::connection('mysql2')
                ->table($table)
                ->orderBy('created_at')
                ->chunk(1000, function ($data) use($mysql, $table, $ignoreId) {
                    $newData = [];
                    foreach ($data as $item) {
                        $item = (array)$item;
                        foreach ($item as $key => $val) {
                            if($key == 'id' && $ignoreId == 1) {
                                unset($item['id']);
                            }
                            if($key ==  'storeName') {
                                $item['store_id'] = (new AmzSettingsRepository())->getStoresId();
                                unset($item['storeName']);
                            }
                            if(in_array($key, ['taskId', 'bRowversion'])) {
                                unset($item[$key]);
                            }
                            if(in_array($key,['marketId','storeId'])) {
                                $item['store_id'] = $item[$key];
                                unset($item[$key]);
                            }
                        }
                        $newData[] = $item;

                    }
                    $mysql->table($table)->insert($newData);

                });



        }
    }
}
