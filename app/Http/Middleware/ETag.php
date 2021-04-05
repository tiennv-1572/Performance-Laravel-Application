<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ETag
{
    public function handle(Request $request, Closure $next)
    {
        $method = $request->getMethod();

        if ($request->isMethod('HEAD')) {
            $request->setMethod('GET');
        }

        //Handle response
        $response = $next($request);

        $etag = '"'.md5($response->getContent()).'"';
        $noneMatch = $request->getETags();

        if (in_array($etag, $noneMatch)) {
            $response->setNotModified();
        }

        $request->setMethod($method);
        $response->setEtag($etag);

        return $response;
    }
}
