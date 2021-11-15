<?php

namespace app\core\helpers;

class Helper {
    public static function ConvertDateTime($datetime) {
        $date = new \DateTime($datetime, new \DateTimeZone("UTC"));
        $tz = new \DateTimeZone(date_default_timezone_get());
        $date->setTimeZone($tz);
        return $date->format('Y-m-d H:i:s');
    }
}