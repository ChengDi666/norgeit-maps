<?php

namespace Norgeit\Maps\Http\Middleware;

use Laravel\Nova\Nova;
use Norgeit\Maps\Maps;

class Authorize
{
    /**
     * Handle the incoming request. 处理传入的请求
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        $tool = collect(Nova::registeredTools())->first([$this, 'matchesTool']);

        return optional($tool)->authorize($request) ? $next($request) : abort(403);
    }

    /**
     * Determine whether this tool belongs to the package.  确定此工具是否属于包
     *
     * @param  \Laravel\Nova\Tool  $tool
     * @return bool
     */
    public function matchesTool($tool)
    {
        return $tool instanceof Maps;
    }
}
