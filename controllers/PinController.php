<?php

namespace Controller;

use Classes\PinAdapter;

class PinController extends BaseController
{
    public function index()
    {
        return 'Use GET (read) & POST (write) /pin/{pin}';
    }

    public function read(int $pin)
    {
        return PinAdapter::read($pin);
    }

    public function write(int $pin, $value)
    {
        return PinAdapter::write($pin, $value);
    }
}
