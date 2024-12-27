<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Merry Christmas {{ $name }}</title>
    @vite('resources/css/app.css')
</head>
<style>
    .background {
        background-image: url('{{ asset("images/top_decor.png") }}');
        background-size: 28rem auto;
        background-repeat: no-repeat;
        background-position: center top;
    }
</style>

<body class="bg-orange-100 background">

{{--<img class="" src="{{ asset("images/top_decor.png") }}" alt="Decor" />--}}

<div class="pt-48 p-4 h-screen max-w-xl mx-auto">
    <div class="border-4 p-3 border-red-600 rounded-lg h-full" dir="rtl">
        @if(!in_array($name, ["boys", "girls"]))
            <h1 class="text-2xl font-bold">
                الابن المبارك/ {{ $name }}
            </h1>
        @endif

        <div class="">
        </div>
    </div>
</div>
</body>
</html>
