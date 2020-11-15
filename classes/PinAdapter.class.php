<?php

/**
 * Pin Adapter
 *
 * Interface for modifying pin mode, output,
 * getting value from pin, and other things of that sort
 */

namespace Classes;

class PinAdapter
{
    /**
     * Returns value of pin
     *
     * @param int $pin
     * @return string
     */
    public static function read($pin)
    {
        return exec("gpio read $pin");
    }

    /**
     * Sets value of pin
     *
     * @param int $pin
     * @param int $value
     * @return string
     * @TODO: currently just returns empty
     */
    public static function write($pin, $value)
    {
        return exec("gpio write $pin $value");
    }

    /**
     * Sets mode of pin
     *
     * @param int $pin
     * @param string $mode
     * @return string
     */
    public static function setMode($pin, $mode)
    {
        return exec("gpio mode $pin $mode");
    }
}
