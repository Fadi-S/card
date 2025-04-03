<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        كل سنة و أنت طيبة
    </title>
    @vite('resources/css/app.css')
</head>
<style></style>

<body class="background">

<div class="p-4 h-screen max-w-xl mx-auto text-center">
    <div class="sm:p-4" dir="rtl">
        <div>
            <video preload="auto" class="object-fill" autoplay controls>
                <source src="{{ $video }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</div>
</body>
</html>
