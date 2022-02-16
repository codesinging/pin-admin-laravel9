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

    public function testRootDirectory()
    {
        self::assertEquals('admins', (new Application())->rootDirectory());
        self::assertEquals('admins' . DIRECTORY_SEPARATOR . 'admin', (new Application())->rootDirectory('admin'));
        self::assertEquals('admins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'config', (new Application())->rootDirectory('admin', 'config'));
    }

    public function testRootPath()
    {
        self::assertEquals(base_path('admins'), (new Application())->rootPath());
        self::assertEquals(base_path('admins' . DIRECTORY_SEPARATOR . 'admin'), (new Application())->rootPath('admin'));
        self::assertEquals(base_path('admins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'config'), (new Application())->rootPath('admin', 'config'));
    }
}
