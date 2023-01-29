<?php

namespace ZoomosApi\Util;

class DateTimeHelper
{
    protected function humanizeTimestamp(int $ts): string
    {
        return $ts ? date('h:i:s Y-m-d', $ts) : '??';
    }
}
