<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

use CodeSinging\PinAdmin\Foundation\Application;
use Illuminate\Config\Repository;

if (!function_exists('admin')) {
    /**
     * 返回 PinAdmin 应用实例
     *
     * @param string|null $name
     *
     * @return Application
     */
    function admin(string $name = null): Application
    {
        /** @var Application $app */
        $app = app(Application::LABEL);
        is_null($name) or $app->boot($name);
        return $app;
    }
}

if (!function_exists('admin_config')) {
    /**
     * 获取或设置应用配置值，或者返回应用仓库实例
     *
     * @param array|string|null $key
     * @param mixed|null $default
     *
     * @return Application|Repository|mixed
     */
    function admin_config(array|string $key = null, mixed $default = null)
    {
        return admin()->config($key, $default);
    }
}
