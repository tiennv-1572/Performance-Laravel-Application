<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <script src="{{ route('cache.last_modified') }}"></script>
    <script src="{{ route('cache.etag') }}"></script>
    <script src="{{ route('cache.expires', ['v' => '1.1']) }}"></script>
    <script src="{{ route('cache.cache_control') }}"></script>
</body>
</html>
