<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <title>Home</title>
</head>
<body>
    <div class="bg-white">
        <x-navbar></x-navbar>
        {{ $slot }}
    </div>
</body>
</html>
