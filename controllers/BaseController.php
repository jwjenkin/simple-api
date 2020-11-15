<?php

/**
 * Base Controller
 *
 * All controllers *should* be based on this,
 * but that's not a hard and fast rule
 */

namespace Controller;

class BaseController
{
    /**
     * Displays the class of the current controller
     *
     * @return string
     */
    public function index()
    {
        return get_class($this);
    }
}
