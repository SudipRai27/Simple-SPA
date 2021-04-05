<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Blog</title>
    <style>
        div#app {
            width: 100%;
        }

    </style>
</head>

<body>
    <div id="app">
        <App></App>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
