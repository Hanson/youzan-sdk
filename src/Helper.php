<?php

namespace Hanson\Youzan;

class Helper
{
    public static function toNull(array &$array)
    {
        foreach ($array as &$item) {
            if (is_array($item)) {
                self::toNull($item);
            } else {
                $item = self::transform($item);
            }
        }

        return $array;
    }

    public static function transform($value)
    {
        return is_string($value) && ($value === '' || $value === 'null') ? null : $value;
    }
}
