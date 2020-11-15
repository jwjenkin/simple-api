<?php

namespace Controller;

class BaseController
{
    public function index()
    {
        return get_class($this);
    }
}
