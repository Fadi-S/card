<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        كل سنة و أنت {{ $name === "girls" ? "طيبة" : "طيب" }}
        {{ $nameShort && !in_array($name, ["girls", "boys"]) ? "يا $nameShort" : ""}}
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Noto+Naskh+Arabic:wght@400..700&family=Noto+Sans+Arabic:wght@100..900&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<style>
    .background {
        background-image: url('{{ asset("images/top_decor.png") }}');
        background-size: 32rem auto;
        background-repeat: no-repeat;
        background-position: center top;
    }
</style>

<body class="bg-orange-100 background">

<div class="pt-32 p-4 h-screen max-w-xl mx-auto">
    <div class="sm:p-4 h-full" dir="rtl">

            @if(!in_array($name, ["boys", "girls"]))
                <h1 class="text-2xl mt-2 font-semibold font-amiri">
                    دعوة خاصة من طفل المذود الي {{ $nameShort }}
                </h1>
            @endif

            <div class="mt-2 text-lg">
                <span>{!! str($mass)->markdown() !!}</span>
                <span>{!! str($party)->markdown() !!}</span>
            </div>

                <img class="w-48 rounded-full mx-auto" src="{{ asset("images/nativity.jpg") }}" alt="Nativity Scene" />
    </div>
</div>
</body>
</html>
