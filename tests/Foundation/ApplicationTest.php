<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace Tests\Foundation;

use CodeSinging\PinAdmin\Foundation\Application;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    public function testVersion()
    {
        self::assertEquals(Application::VERSION, (new Application())->version());
    }

    public function testLabel()
    {
        self::assertEquals('admin', (new Application())->label());
        self::assertEquals('admin_config', (new Application())->label('config'));
        self::assertEquals('admin-config', (new Application())->label('config', '-'));
    }
}
