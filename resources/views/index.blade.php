<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Site</title>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>

    <h1>Welcome to My Laravel Demo</h1>

    <img src="{{ asset('uploads/img/banner1.jpg') }}" alt="Banner 1" width="400">
    <img src="{{ asset('uploads/img2/banner2.jpg') }}" alt="Banner 2" width="400">

    <!-- JS Files -->
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>
</html>
