<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>
<body>
<div class="container">
    <a href="{{route('users.index')}}" class="btn btn-outline-primary mt-5">Перейти на страницу с Пользователями</a>
    <h1 class="mt-5 mb-4 text-center">@yield('title')</h1>
    @yield('content')
</div>
<script src="/js/bootstrap.min.js"></script>
<script src="https://getbootstrap.com/docs/5.0/examples/checkout/form-validation.js"></script>
</body>
</html>
