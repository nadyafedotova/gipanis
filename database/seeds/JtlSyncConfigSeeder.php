<?php

use App\Models\Jtl\JtlSyncConfig;
use Illuminate\Database\Seeder;

class JtlSyncConfigSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateMultiple([
            'jtl_sync_config',
        ]);

        JtlSyncConfig::create([
            'code' => 'J01',
            'tableJTL' => 'tArtikel',
            'table' => 'jtl_artikel',
            'timer_d' => 0.00,
            'timer_h' => 1.0000,
            'only_new' => 0,
            'status' => 1,

        ]);

        JtlSyncConfig::create([
            'code' => 'J02',
            'tableJTL' => 'tlagerbestand',
            'table' => 'jtl_lagerbestand',
            'timer_d' => 0.00,
            'timer_h' => 0.5000,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J03',
            'tableJTL' => 'tWarenLagerPlatz',
            'table' => 'jtl_lagerplatz_report',
            'timer_d' => 0.00,
            'timer_h' => 1.0100,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J04',
            'tableJTL' => 'tbestellpos',
            'table' => 'jtl_tbestellpos',
            'timer_d' => 0.00,
            'timer_h' => 0.0700,
            'only_new' => 1,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J05',
            'tableJTL' => 'tBestellung',
            'table' => 'jtl_tBestellung',
            'timer_d' => 0.00,
            'timer_h' => 2.0000,
            'only_new' => 1,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J06',
            'tableJTL' => 'tPlattform',
            'table' => 'jtl_tPlattform',
            'timer_d' => 0.00,
            'timer_h' => 1.0200,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J07',
            'tableJTL' => 'tWarenLager',
            'table' => 'jtl_warenlager',
            'timer_d' => 0.00,
            'timer_h' => 1.0300,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J08',
            'tableJTL' => 'tkategorie',
            'table' => 'jtl_tkategorie',
            'timer_d' => 0.00,
            'timer_h' => 1.0600,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J09',
            'tableJTL' => 'tkategorieartikel',
            'table' => 'jtl_tkategorieartikel',
            'timer_d' => 0.00,
            'timer_h' => 1.0600,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J10',
            'tableJTL' => 'tKategorieSprache',
            'table' => 'jtl_tKategorieSprache',
            'timer_d' => 0.00,
            'timer_h' => 1.0000,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J11',
            'tableJTL' => 'tStueckliste',
            'table' => 'jtl_tStueckliste',
            'timer_d' => 0.00,
            'timer_h' => 1.0600,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J12',
            'tableJTL' => 'tliefartikel',
            'table' => 'jtl_tliefartikel',
            'timer_d' => 0.00,
            'timer_h' => 1.0600,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J13',
            'tableJTL' => 'tlieferant',
            'table' => 'jtl_tlieferant',
            'timer_d' => 0.00,
            'timer_h' => 1.0000,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J14',
            'tableJTL' => 'tLieferantenBestellungPos',
            'table' => 'jtl_tLieferantenBestellungPos',
            'timer_d' => 0.00,
            'timer_h' => 1.0000,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J15',
            'tableJTL' => 'tWarenLagerEingang',
            'table' => 'jtl_tWarenLagerEingang',
            'timer_d' => 0.00,
            'timer_h' => 1.0000,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J16',
            'tableJTL' => 'tArtikelAttribut',
            'table' => 'jtl_artikel_attribut',
            'timer_d' => 0.00,
            'timer_h' => 1.0020,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J17',
            'tableJTL' => 'tArtikelBeschreibung',
            'table' => 'jtl_artikel_beschreibung',
            'timer_d' => 0.00,
            'timer_h' => 0.6000,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J18',
            'tableJTL' => 'tArtikelAttributSprache',
            'table' => 'jtl_artikel_attribut_sprache',
            'timer_d' => 0.00,
            'timer_h' => 1.0020,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J19',
            'tableJTL' => 'tArtikelMerkmal',
            'table' => 'jtl_artikel_merkmal',
            'timer_d' => 0.00,
            'timer_h' => 1.0020,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J20',
            'tableJTL' => 'tMerkmalSprache',
            'table' => 'jtl_merkmal_sprache',
            'timer_d' => 0.00,
            'timer_h' => 1.0030,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J21',
            'tableJTL' => 'tAttribut',
            'table' => 'jtl_attribut',
            'timer_d' => 0.00,
            'timer_h' => 1.0040,
            'only_new' => 0,
            'status' => 1,
        ]);

        JtlSyncConfig::create([
            'code' => 'J22',
            'tableJTL' => 'tMerkmalWertSprache',
            'table' => 'jtl_merkmal_wert_sprache',
            'timer_d' => 0.00,
            'timer_h' => 1.0020,
            'only_new' => 0,
            'status' => 1,
        ]);


    }
}
