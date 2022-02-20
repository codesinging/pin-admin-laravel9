<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

use CodeSinging\PinAdmin\Console\AdminCommand;
use CodeSinging\PinAdmin\Console\CreateCommand;
use CodeSinging\PinAdmin\Console\ListCommand;
use CodeSinging\PinAdmin\Middleware\Auth;
use CodeSinging\PinAdmin\Middleware\Guest;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * 控制台命令
     *
     * @var array
     */
    protected array $commands = [
        AdminCommand::class,
        CreateCommand::class,
        ListCommand::class,
    ];

    /**
     * 所有应用
     *
     * @var Application[]
     */
    protected array $applications = [];

    /**
     * 注册 PinAdmin 服务
     *
     * @return void
     */
    public function register()
    {
        $this->registerBinding();
    }

    /**
     * 启动 PinAdmin 服务
     *
     * @return void
     */
    public function boot()
    {
        $this->initApplications();

        if ($this->app->runningInConsole()) {
            $this->registerCommands();
            $this->registerMigrations();
        }

        if (!$this->app->routesAreCached()) {
            $this->registerRoutes();
        }

        $this->registerMiddlewares();
        $this->registerViews();
        $this->setAuthenticationConfig();
    }

    /**
     * 初始化所有应用
     *
     * @return void
     */
    private function initApplications()
    {
        foreach (Admin::indexes() as $name => $options) {
            if ($options['status']) {
                $this->applications[$name] = new Application($name);
            }
        }
    }

    /**
     * 注册容器
     *
     * @return void
     */
    private function registerBinding()
    {
        $this->app->singleton(Application::LABEL, Application::class);
    }

    /**
     * 注册控制台命令
     *
     * @return void
     */
    private function registerCommands()
    {
        $this->commands($this->commands);
    }

    /**
     * 注册数据库迁移目录
     *
     * @return void
     */
    private function registerMigrations()
    {
        foreach ($this->applications as $application) {
            $this->loadMigrationsFrom($application->path('migrations'));
        }
    }

    /**
     * 注册路由
     *
     * @return void
     */
    private function registerRoutes()
    {
        foreach ($this->applications as $application) {
            Route::prefix($application->routePrefix())
                ->middleware($application->config('middlewares.guest'))
                ->group(fn() => $this->loadRoutesFrom($application->path('routes', 'guest.php')));

            Route::prefix($application->routePrefix())
                ->middleware($application->config('middlewares.auth'))
                ->group(fn() => $this->loadRoutesFrom($application->path('routes', 'auth.php')));
        }
    }

    /**
     * 注册中间件
     *
     * @return void
     */
    private function registerMiddlewares()
    {
        /** @var Router $router */
        $router = $this->app['router'];

        $router->aliasMiddleware(Admin::label('auth', '.'), Auth::class);
        $router->aliasMiddleware(Admin::label('guest', '.'), Guest::class);
    }

    /**
     * 注册视图命名空间
     *
     * @return void
     */
    private function registerViews()
    {
        $this->loadViewsFrom(Admin::packagePath('resources', 'views'), Admin::label());

        foreach ($this->applications as $application) {
            $this->loadViewsFrom($application->path('resources/views'), Admin::label($application->name(), '_'));
        }
    }

    /**
     * 设置应用认证守卫和提供者配置
     *
     * @return void
     */
    private function setAuthenticationConfig()
    {
        foreach ($this->applications as $application) {
            Config::set('auth.guards.' . $application->guard(), $application->config('auth_guard'));
            Config::set('auth.providers.' . $application->config('auth_guard.provider'), $application->config('auth_provider'));
        }
    }
}
