<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace Tests\Foundation;

use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Foundation\Application;
use Tests\TestCase;

class AdminTest extends TestCase
{
    public function testVersion()
    {
        self::assertEquals(Application::VERSION, Admin::version());
    }
}
