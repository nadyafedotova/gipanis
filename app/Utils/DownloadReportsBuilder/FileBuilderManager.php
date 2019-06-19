<?php

namespace App\Utils\DownloadReportsBuilder;


use App\Utils\DownloadReportsBuilder\Exceptions\DownloadReportsBuilderException;

class FileBuilderManager
{

    public function builder(string $code, string $type) {
        $namespaceClass = "App\\Utils\\DownloadReportsBuilder\\Builder\\";
        $class = strtoupper($code).ucfirst($type).'Builder';
        if(class_exists($namespaceClass.$class)) {

            return app()->make($namespaceClass.$class);
        }

        throw new DownloadReportsBuilderException('File builder with code and not found');

    }
}