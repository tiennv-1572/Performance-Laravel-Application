<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CachingTestController extends Controller
{

    public function index()
    {
        return view('cache.index');
    }

    public function lastModified()
    {
        return response()
            ->view('cache.last-modified')
            ->header('Last-Modified', 'Thu, 14 Feb 2020 23:02:38 GMT');
    }

    public function etag()
    {
        return view('cache.etag');
    }

    public function expires()
    {
        return response()
            ->view('cache.expires')
            ->header('Expires', 'Mar 20 2020');
    }

    public function cacheControl()
    {
        return response()
            ->view('cache.cache-control')
            ->header('Cache-Control', 'max-age=60');
    }
}
