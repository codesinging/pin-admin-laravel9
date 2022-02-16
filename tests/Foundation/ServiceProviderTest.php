<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace Tests\Foundation;

use CodeSinging\PinAdmin\Foundation\Application;
use Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    public function testRegisterBinding()
    {
        self::assertInstanceOf(Application::class, app(Application::LABEL));
        self::assertSame(app(Application::LABEL), app(Application::LABEL));
    }
}
