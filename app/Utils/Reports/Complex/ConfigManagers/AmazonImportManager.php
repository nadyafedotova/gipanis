<?php

namespace App\Utils\Reports\Complex\ConfigManagers;

use App\Utils\Reports\Complex\AmazonImportConfig;
use App\Utils\Reports\Complex\Contract\ReportsConfigContract;
use App\Utils\Reports\Complex\Contract\ReportsManagerContract;

class AmazonImportManager implements ReportsManagerContract
{

    /**
     * @var AmazonImportConfig
     */
    protected $config;

    public function manage(string $configName)
    {
        if ($configName == 'import') {
            $this->import();
        } else {
            $this->web();
        }
        return $this;
    }

    public function getConfig(): ReportsConfigContract
    {
        return $this->config;
    }

    protected function import()
    {
        $option['amzImport'] = true;
        $this->config = new AmazonImportConfig($option);
    }

    protected function web()
    {
        $this->config = new AmazonImportConfig();
    }


}