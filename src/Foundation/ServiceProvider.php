<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

use CodeSinging\PinAdmin\Console\ListCommand;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * 控制台命令
     * @var array
     */
    protected array $commands = [
        ListCommand::class,
    ];

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
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()){
            $this->registerCommands();
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
    protected function registerCommands()
    {
        $this->commands($this->commands);
    }
}
