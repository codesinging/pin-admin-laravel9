<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace Tests\Support;

use CodeSinging\PinAdmin\Foundation\Application;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    public function testAdmin()
    {
        self::assertInstanceOf(Application::class, admin());
    }
}
