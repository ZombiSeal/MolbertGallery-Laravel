<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Document</title>
</head>
<body>
    @include('header')

    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>

    <script src="/js/filter.js"></script>
    <script src="/js/cart.js"></script>
    <script src="/js/order.js"></script>
    <script src="/js/account.js"></script>
<script src="/js/account1.js"></script>

</body>
</html>

