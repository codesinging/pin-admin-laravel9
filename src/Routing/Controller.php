<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Routing;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class Controller extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 返回正确的 json 响应
     *
     * @param Model|array|string|Collection|null $message
     * @param Model|array|Collection|null $data
     *
     * @return JsonResponse
     */
    protected function success(Model|array|string|Collection $message = null, Model|array|Collection $data = null): JsonResponse
    {
        return Response::success($message, $data);
    }

    /**
     * 返回错误的 json 响应
     *
     * @param string|null $message
     * @param int $code
     * @param mixed|null $data
     *
     * @return JsonResponse
     */
    protected function error(string $message = null, int $code = -1, mixed $data = null): JsonResponse
    {
        return Response::error($message, $code, $data);
    }
}
