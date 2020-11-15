<?php

/**
 * Pin Controller
 *
 * Generic pin management (likely should be removed)
 */

namespace Controller;

use Classes\PinAdapter;

class PinController extends BaseController
{
    /**
     * Explains endpoints
     *
     * @return string
     */
    public function index()
    {
        return 'Use GET (read) & POST (write) /pin/{pin}';
    }

    /**
     * Returns current value of given pin
     *
     * @param int $pin
     * @return string
     */
    public function read(int $pin)
    {
        return PinAdapter::read($pin);
    }

    /**
     * Writes value to given pin
     *
     * @param int $pin
     * @param string $value
     * @return string
     */
    public function write(int $pin, $value)
    {
        return PinAdapter::write($pin, $value);
    }
}
