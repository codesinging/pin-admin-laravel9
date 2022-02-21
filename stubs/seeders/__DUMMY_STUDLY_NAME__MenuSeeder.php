<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace __DUMMY_NAMESPACE__\Seeders;

use __DUMMY_NAMESPACE__\Models\__DUMMY_STUDLY_NAME__Menu;
use Illuminate\Database\Seeder;

class __DUMMY_STUDLY_NAME__MenuSeeder extends Seeder
{
    private array $menus = [
        ['name' => '首页', 'path' => 'home', 'icon' => 'bi-house', 'is_home' => true],
        ['name' => '系统管理', 'path' => 'system', 'icon' => 'bi-gear', 'is_opened' => true, 'children' => [
            ['name' => '菜单管理', 'path' => 'menus', 'icon' => 'bi-list'],
            ['name' => '管理员管理', 'path' => 'admins', 'icon' => 'bi-person'],
        ]],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        __DUMMY_STUDLY_NAME__Menu::truncate();

        foreach ($this->menus as $menu) {
            __DUMMY_STUDLY_NAME__Menu::create($menu);
        }
    }
}
