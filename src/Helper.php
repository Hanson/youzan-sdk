<?php


namespace Hanson\Youzan;


trait Helper
{
    public function toNull(array &$array)
    {
        foreach ($array as &$item) {
            if (is_array($item)) {
                $this->toNull($item);
            } else {
                $item = $this->transform($item);
            }
        }

        return $array;
    }

    public function transform($value)
    {
        return is_string($value) && ($value === '' || $value === 'null') ? null : $value;
    }
}