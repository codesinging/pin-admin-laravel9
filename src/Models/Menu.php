<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Models;

use CodeSinging\PinAdmin\Support\Model\Model;
use Kalnoy\Nestedset\NodeTrait;

class Menu extends Model
{
    use NodeTrait;

    protected $fillable = [
        'name',
        'url',
        'path',
        'icon',
        'sort',
        'is_home',
        'is_opened',
        'status',
    ];

    protected $casts = [
        'is_home' => 'boolean',
        'is_opened' => 'boolean',
        'status' => 'boolean',
    ];
}
