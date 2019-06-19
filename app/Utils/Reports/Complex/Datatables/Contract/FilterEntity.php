<?php

namespace App\Utils\Reports\Complex\Datatables\Contract;

/**
 * Interface FilterEntity
 * @package App\Utils\Reports\Complex\Datatables\Contract
 */
interface FilterEntity
{
    /**
     * @param string $name
     * @return mixed
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $label
     * @return mixed
     */
    public function setLabel(string $label);

    /**
     * @return string
     */
    public function getLabel(): string;

    /**
     * @param string $type
     * @return mixed
     */
    public function setType(string $type);

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param array $values
     */
    public function setValues(array $values);

    /**
     * @return array
     */
    public function getValues(): array;

    /**
     * @param string $value
     * @return mixed
     */
    public function setValue($value);

    /**
     * @return mixed
     */
    public function getValue();
}