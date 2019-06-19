<?php

namespace App\Utils\HistoryTableBuilder;

interface HistoryTableBuilderContract
{

    public function build();

    public function addColumn();

    public function createTable();

    public function updateTable();
}