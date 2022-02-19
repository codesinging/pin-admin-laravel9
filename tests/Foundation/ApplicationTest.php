<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace Tests\Foundation;

use CodeSinging\PinAdmin\Foundation\Application;
use Illuminate\Config\Repository;
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

    public function testRootAppDirectory()
    {
        self::assertEquals('Admins', (new Application())->rootAppDirectory());
        self::assertEquals('Admins' . DIRECTORY_SEPARATOR . 'Admin', (new Application())->rootAppDirectory('Admin'));
        self::assertEquals('Admins' . DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'Controllers', (new Application())->rootAppDirectory('Admin', 'Controllers'));
    }

    public function testRootAppPath()
    {
        self::assertEquals(app_path('Admins'), (new Application())->rootAppPath());
        self::assertEquals(app_path('Admins' . DIRECTORY_SEPARATOR . 'Admin'), (new Application())->rootAppPath('Admin'));
        self::assertEquals(app_path('Admins' . DIRECTORY_SEPARATOR . 'Admin' . DIRECTORY_SEPARATOR . 'Controllers'), (new Application())->rootAppPath('Admin', 'Controllers'));
    }

    public function testRootPublicDirectory()
    {
        self::assertEquals('admins', (new Application())->rootPublicDirectory());
        self::assertEquals('admins' . DIRECTORY_SEPARATOR . 'admin', (new Application())->rootPublicDirectory('admin'));
        self::assertEquals('admins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'js', (new Application())->rootPublicDirectory('admin', 'js'));
    }

    public function testRootPublicPath()
    {
        self::assertEquals(app_path('admins'), (new Application())->rootPublicPath());
        self::assertEquals(app_path('admins' . DIRECTORY_SEPARATOR . 'admin'), (new Application())->rootPublicPath('admin'));
        self::assertEquals(app_path('admins' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'js'), (new Application())->rootPublicPath('admin', 'js'));
    }

    public function testPackagePath()
    {
        self::assertEquals(dirname(__DIR__), (new Application())->packagePath('tests'));
        self::assertEquals(__DIR__, (new Application())->packagePath('tests', 'Foundation'));
    }

    public function testName()
    {
        self::assertEquals('admin', (new Application('admin'))->name());
        self::assertEquals('admin_users', (new Application('admin'))->name('users'));
        self::assertEquals('admin-config', (new Application('admin'))->name('config', '-'));
    }

    public function testStudlyName()
    {
        self::assertEquals('Admin', (new Application())->boot('admin')->studlyName());
        self::assertEquals('AdminUser', (new Application())->boot('admin')->studlyName('user'));
    }

    public function testGuard()
    {
        self::assertEquals('admin', (new Application('admin'))->guard());
    }

    public function testDirectory()
    {
        self::assertEquals('admins/user', (new Application('user'))->directory());
        self::assertEquals('admins/user/config', (new Application('user'))->directory('config'));
        self::assertEquals('admins/user/config/app.php', (new Application('user'))->directory('config', 'app.php'));
    }

    public function testPath()
    {
        self::assertEquals(base_path('admins/user'), (new Application('user'))->path());
        self::assertEquals(base_path('admins/user/config'), (new Application('user'))->path('config'));
        self::assertEquals(base_path('admins/user/config/app.php'), (new Application('user'))->path('config', 'app.php'));
    }

    public function testAppDirectory()
    {
        self::assertEquals('Admins/Admin', (new Application('admin'))->appDirectory());
        self::assertEquals('Admins/Admin/Controllers', (new Application('admin'))->appDirectory('Controllers'));
        self::assertEquals('Admins/Admin/Controllers/Controller.php', (new Application('admin'))->appDirectory('Controllers', 'Controller.php'));
    }

    public function testAppPath()
    {
        self::assertEquals(app_path('Admins/Admin'), (new Application('admin'))->appPath());
        self::assertEquals(app_path('Admins/Admin/Controllers'), (new Application('admin'))->appPath('Controllers'));
        self::assertEquals(app_path('Admins/Admin/Controllers/Controller.php'), (new Application('admin'))->appPath('Controllers', 'Controller.php'));
    }

    public function testPublicDirectory()
    {
        self::assertEquals('admins/admin', (new Application('admin'))->publicDirectory());
        self::assertEquals('admins/admin/js', (new Application('admin'))->publicDirectory('js'));
        self::assertEquals('admins/admin/js/app.js', (new Application('admin'))->publicDirectory('js', 'app.js'));
    }

    public function testPublicPath()
    {
        self::assertEquals(public_path('admins/admin'), (new Application('admin'))->publicPath());
        self::assertEquals(public_path('admins/admin/js'), (new Application('admin'))->publicPath('js'));
        self::assertEquals(public_path('admins/admin/js/app.js'), (new Application('admin'))->publicPath('js', 'app.js'));
    }

    public function testGetNamespace()
    {
        self::assertEquals('App\\Admins\\Admin', (new Application('admin'))->getNamespace());
        self::assertEquals('App\\Admins\\Admin\\Controllers', (new Application('admin'))->getNamespace('Controllers'));
    }

    public function testBoot()
    {
        self::assertInstanceOf(Application::class, (new Application())->boot('admin'));
        self::assertEquals('admin', (new Application())->boot('admin')->name());
        self::assertEquals('shop', (new Application())->boot('shop')->name());
    }

    public function testConfig()
    {
        $app = new Application('admin');

        $app->config(['title' => 'Title']);

        self::assertInstanceOf(Repository::class, $app->config());
        self::assertIsArray($app->config()->all());
        self::assertEquals('Title', $app->config('title'));
        self::assertNull($app->config('key_not_exists'));
        self::assertEquals('Default', $app->config('key_not_exists', 'Default'));
    }

    public function testRoutePrefix()
    {
        $app = new Application('admin');

        self::assertEquals('admin', $app->routePrefix());

        $app->config(['route_prefix' => 'admin123']);
        self::assertEquals('admin123', $app->routePrefix());
    }

    public function testLink()
    {
        self::assertEquals('/admin', (new Application('admin'))->link());
        self::assertEquals('/admin/home', (new Application('admin'))->link('home'));
        self::assertEquals('/admin/home?id=1', (new Application('admin'))->link('home', ['id' => 1]));
    }

    public function testAsset()
    {
        self::assertEquals('/static/app.js', (new Application())->asset('/static/app.js'));
        self::assertEquals('/admins/admin', (new Application('admin'))->asset());
        self::assertEquals('/admins/admin/js/app.js', (new Application('admin'))->asset('js/app.js'));
    }

    public function testHomeUrl()
    {
        self::assertEquals('/admin', (new Application('admin'))->homeUrl());
    }

    public function testTemplate()
    {
        self::assertEquals('admin_admin::layout.app', (new Application('admin'))->template('layout.app'));
    }
}
