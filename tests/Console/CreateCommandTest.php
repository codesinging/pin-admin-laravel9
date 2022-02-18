<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace Tests\Console;

use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class CreateCommandTest extends TestCase
{
    protected function tearDown(): void
    {
        File::deleteDirectory(Admin::rootPath());
        File::deleteDirectory(Admin::rootAppPath());
        File::deleteDirectory(Admin::rootPublicPath());
    }

    public function testCreateDirectories()
    {
        if (File::exists(Admin::rootPath())) {
            File::deleteDirectory(Admin::rootPath());
        }

        if (File::exists(Admin::rootAppPath())) {
            File::deleteDirectory(Admin::rootAppPath());
        }

        if (File::exists(Admin::rootPublicPath())) {
            File::deleteDirectory(Admin::rootPublicPath());
        }

        $this->artisan('admin:create admin')->run();

        self::assertDirectoryExists(Admin::rootPath());
        self::assertDirectoryExists(Admin::rootAppPath());
        self::assertDirectoryExists(Admin::rootPublicPath());
    }

    public function testCreateRoutes()
    {
        Admin::boot('admin');
        self::assertFileDoesNotExist(Admin::path('routes', 'auth.php'));
        $this->artisan('admin:create admin')->run();
        self::assertFileExists(Admin::path('routes', 'auth.php'));
    }

    public function testCreateConfigs()
    {
        Admin::boot('admin');
        self::assertFileDoesNotExist(Admin::path('config', 'app.php'));
        $this->artisan('admin:create admin')->run();
        self::assertFileExists(Admin::path('config', 'app.php'));
    }

    public function testCreateControllers()
    {
        Admin::boot('admin');
        self::assertFileDoesNotExist(Admin::appPath('Controllers', 'IndexController.php'));
        $this->artisan('admin:create admin')->run();
        self::assertFileExists(Admin::appPath('Controllers', 'IndexController.php'));
    }

    public function testCreateModels()
    {
        Admin::boot('admin');
        self::assertFileDoesNotExist(Admin::appPath('Models', Admin::studlyName('User.php')));
        $this->artisan('admin:create admin')->run();
        self::assertFileExists(Admin::appPath('Models', Admin::studlyName('User.php')));
    }

    public function testCreateMigrations()
    {
        Admin::boot('admin');
        self::assertDirectoryDoesNotExist(Admin::path('migrations'));
        $this->artisan('admin:create admin')->run();
        self::assertDirectoryExists(Admin::path('migrations'));
    }

    public function testCreateSeeders()
    {
        Admin::boot('admin');
        self::assertFileDoesNotExist(Admin::appPath('Seeders', 'DatabaseSeeder.php'));
        $this->artisan('admin:create admin')->run();
        self::assertFileExists(Admin::appPath('Seeders', 'DatabaseSeeder.php'));
    }

    public function testUpdateIndexes()
    {
        self::assertFileDoesNotExist(Admin::rootPath(Application::INDEX_FILENAME));
        $this->artisan('admin:create admin')->run();
        self::assertFileExists(Admin::rootPath(Application::INDEX_FILENAME));
        self::assertCount(1, require(Admin::rootPath(Application::INDEX_FILENAME)));
        $this->artisan('admin:create admin2')->run();
        self::assertCount(2, require(Admin::rootPath(Application::INDEX_FILENAME)));
    }

    public function testInitDatabase()
    {
        $this->artisan('admin:create admin')->run();
        $this->assertNull(DB::table('admin_users')->first());
    }
}
