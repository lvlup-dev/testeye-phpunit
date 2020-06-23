<?php

namespace Lvlup\SlowTests;

use PHPUnit\Runner\AfterTestHook;

class SlowTestsHook implements AfterTestHook
{
    /**
     * This hook will fire after any test, regardless of the result.
     *
     * For more fine grained control, have a look at the other hooks
     * that extend PHPUnit\Runner\Hook.
     */
    public function executeAfterTest(string $test, float $time): void
    {
        dd("OK");
    }
}
