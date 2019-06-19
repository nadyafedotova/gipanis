<?php
/**
 * Created by PhpStorm.
 * User: anastatia
 * Date: 08/03/2019
 * Time: 13:18
 */

namespace App\Helpers\General;


use App\Exceptions\InitModelException;
use App\Repositories\ReportsConfigRepository;

class InitModel
{
    protected $reportsConfigRepository;

    public function __construct(ReportsConfigRepository $reportsConfigRepository)
    {
        $this->reportsConfigRepository = $reportsConfigRepository;
    }

    public function getByCode(string $code) {

        $table = $this->reportsConfigRepository
            ->where('code', $code)
            ->first();
        if (is_null($table)) {
            throw new InitModelException("Can not find a entity by code " . $code);
        }

        return new $table->entity;
    }
}