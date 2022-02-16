<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Foundation;

class Application
{
    /**
     * PinAdmin 版本号
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * PinAdmin 标记
     */
    const LABEL = 'admin';

    /**
     * 返回 PinAdmin 版本号
     *
     * @return string
     */
    public function version(): string
    {
        return self::VERSION;
    }
}
