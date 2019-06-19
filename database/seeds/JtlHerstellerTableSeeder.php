<?php

use Illuminate\Database\Seeder;
use App\Models\Jtl\JtlHersteller;

class JtlHerstellerTableSeeder extends Seeder
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
            'jtl_hersteller',
        ]);

        JtlHersteller::create([
            'KHersteller' => 1,
            'cName' => 'Grinscard',
            'cHomepage' => NULL,
            'nSort' => 0,
        ]);

        JtlHersteller::create([
            'KHersteller' => 5,
            'cName' => 'LAUBLUST',
            'cHomepage' => NULL,
            'nSort' => 1,
        ]);

        JtlHersteller::create([
            'KHersteller' => 6,
            'cName' => 'Kekskrone',
            'cHomepage' => NULL,
            'nSort' => 3,
        ]);

        JtlHersteller::create([
            'KHersteller' => 7,
            'cName' => 'gipanis',
            'cHomepage' => NULL,
            'nSort' => 2,
        ]);


        $this->enableForeignKeys();
    }
}
