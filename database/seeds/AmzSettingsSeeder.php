<?php

use Illuminate\Database\Seeder;
use App\Models\Amazon\AmzSettings;

class AmzSettingsSeeder extends Seeder
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
            'amz_settings',
        ]);

        AmzSettings::create([
            'store' => 'Amazon.de',
            'country' => 'GERMANY',
        ]);
        AmzSettings::create([
            'store' => 'Amazon.it',
            'country' => 'ITALY',
        ]);
        AmzSettings::create([
            'store' => 'Amazon.fr',
            'country' => 'FRANCE',
        ]);
        AmzSettings::create([
            'store' => 'Amazon.co.uk',
            'country' => 'UK',
        ]);
        AmzSettings::create([
            'store' => 'Amazon.se',
            'country' => 'SPAIN',
        ]);

        $this->enableForeignKeys();
    }
}
