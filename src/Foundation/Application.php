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
     * PinAdmin 品牌名称
     */
    const BRAND = 'PinAdmin';

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

    /**
     * 返回 PinAdmin 的品牌名
     *
     * @return string
     */
    public function brand(): string
    {
        return self::BRAND;
    }

    /**
     * 返回 PinAdmin 标记及以该标记为前缀的字符串
     *
     * @param string|null $suffix
     * @param string $separator
     *
     * @return string
     */
    public function label(string $suffix = null, string $separator = '_'): string
    {
        return self::LABEL . ($suffix ? $separator . $suffix : '');
    }
}
