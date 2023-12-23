<!DOCTYPE html>
<html lang="en" data-theme="default">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('admin.components.style')
    <title>Panel</title>
</head>
<body>
    @include('admin.components.sidebar')
    <div class="vertical-overlay"></div>
    <div class="main-content">
        @yield('content')
    </div>
    @include('admin.components.header')
    @include('admin.components.scripts')
 
</body>
</html>