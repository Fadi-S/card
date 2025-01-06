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
    @vite('resources/css/app.css')
</head>
<style>
    .background {
        background-image: url('{{ asset("images/bg_stars.jpg") }}');
        background-repeat: no-repeat repeat;
        background-position: center top;
        background-size: cover;
    }
</style>

<body class="background">

<div class="p-4 h-screen max-w-xl mx-auto text-center">
    <div class="sm:p-4 " dir="rtl">
        <h1 class="text-2xl mt-2 font-semibold font-hadith">
            دعوة خاصة من طفل المذود
            {{ !in_array($name, ["boys", "girls"]) ? "الي $nameShort" : "" }}
        </h1>


        <div class="mt-2 text-lg">
            <span>{!! str($mass)->markdown() !!}</span>
            <br>
            <span>{!! str($party)->markdown() !!}</span>
        </div>

        <br>
        <div>
            <video preload="auto" class="object-fill" autoplay controls>
                <source src="{{ $video }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>

        <img class="w-64 rounded-full mx-auto" src="{{ asset("images/nativity_white.png") }}" alt="Nativity Scene"/>
    </div>
</div>
</body>
</html>
