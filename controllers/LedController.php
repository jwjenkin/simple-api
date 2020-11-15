<?php

/**
 * LED Controller
 *
 * Handles LED actions
 */

namespace Controller;

use Classes\PinAdapter;

class LedController extends BaseController
{
    const LED_PIN = 4;

    /**
     * Explains endpoints
     *
     * @return string
     */
    public function index()
    {
        return 'Use GET /led/toggle';
    }

    /**
     * Toggles LED_PIN on and off
     *
     * @return array
     */
    public function toggle()
    {
        $currentState = (int) PinAdapter::read(self::LED_PIN);
        $newState = $currentState ? 0 : 1;
        PinAdapter::write(self::LED_PIN, $newState);

        return [ 'success' => true, 'old_state' => $currentState, 'new_state' => $newState ];
    }
}
