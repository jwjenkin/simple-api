<?php

namespace Classes;

class PinAdapter
{
    public static function read($pin)
    {
        return exec("gpio read $pin");
    }

    public static function write($pin, $value)
    {
        return exec("gpio write $pin $value");
    }

    public static function setMode($pin, $mode)
    {
        return exec("gpio mode $pin $mode");
    }
}
