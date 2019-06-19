<?php

namespace App\Utils\DownloadReportsBuilder\Facade;

/**
 * @method static \App\Utils\DownloadReportsBuilder\FileBuilderManager  builder(string $code, string $type)
 *
 * @see \App\Utils\DownloadReportsBuilder\FileBuilderManager
 */

use Illuminate\Support\Facades\Facade;

class FileBuilder extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'fileBuilder';
    }
}