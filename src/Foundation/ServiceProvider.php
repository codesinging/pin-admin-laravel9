<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
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
     * 注册容器
     *
     * @return void
     */
    private function registerBinding()
    {
        $this->app->singleton(Application::LABEL, Application::class);
    }
}
