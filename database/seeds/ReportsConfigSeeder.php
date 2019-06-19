<?php

use Illuminate\Database\Seeder;

class ReportsConfigSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();

        $this->truncateMultiple([
            'reports_config',
        ]);

        $report_config[0] = [
            'code' => 'J01',
            'name_table' => 'jtl_artikel',
            'name' => 'J01. tArtikel',
            'action' => 'jtl_artikel',
            'group' => 'jtl',
            'schedules' => 'a:4:{s:4:"days";s:4:"0.00";s:5:"hours";s:6:"1.0000";s:8:"interval";i:0;s:6:"atTime";i:0;}',
            'history' => 0,
            'schedules_history' => NULL,
            'countries' => NULL

        ];

        $report_config[1] = [
            'code' => 'a01',
            'name_table' => 'amz_fba_history',
            'name' => 'A01 FBA_MYI_UNSUPPRESSED_INVENTORY_DATA',
            'action' => 'amz_GET_FBA_MYI_UNSUPPRESSED_INVENTORY_DATA_',
            'group' => 'amz',
            'schedules' => 'a:4:{s:4:"days";i:0;s:5:"hours";d:0.5;s:8:"interval";i:0;s:6:"atTime";i:0;}',
            'history' => 1,
            'schedules_history' => 'a:2:{s:6:"saveIn";a:5:{s:4:"type";N;s:5:"value";N;s:5:"hours";s:4:"3:00";s:8:"interval";i:0;s:6:"atTime";i:1;}s:8:"deleteIn";a:5:{s:4:"type";s:5:"month";s:5:"value";i:25;s:5:"hours";i:0;s:8:"interval";i:0;s:6:"atTime";i:0;}}',
            'countries' => json_encode(["GERMANY"])
        ];

        $report_config[2] = [
            'code' => 'b01',
            'name_table' => 'amz_detailed_sales',
            'name' => 'B01 Detailed sales & traffic',
            'action' => 'b_detailed_sales',
            'group' => 'и',
            'schedules' => 'a:4:{s:4:"days";i:1;s:5:"hours";i:0;s:8:"interval";i:0;s:6:"atTime";i:0;}',
            'history' => 0,
            'schedules_history' => NULL,
            'countries' => NULL
        ];

        \Illuminate\Support\Facades\DB::table('reports_config')->insert($report_config);
        $this->enableForeignKeys();
    }
}
