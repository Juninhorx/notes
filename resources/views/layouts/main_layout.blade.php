<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOTES</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css', true )}}">
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.min.css', true )}}">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png', true )}}" type="image/png">
</head>
<body>

    {{-- Vai puxar o elemento como content --}}
    @yield('content')

    <script src="{{asset('assets/bootstrap/bootstrap.bundle.min.js', true)}}"></script>
</body>
</html>
