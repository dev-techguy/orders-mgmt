<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-200 h-screen">
    <div id="app" class="px-2 lg:p-0 lg:w-2/3 mx-auto">
        <img src="https://adcash.com/wp-content/themes/adcash/assets/dist/img/logo-adcash.svg" alt="adcash logo" class="mt-6 h-8 lg:h-10">
        <orders-app></orders-app>
        <footer class="text-center mt-6">
            <p class="text-gray-700">
                Copyright &copy; {{ date('Y') }}. Made with &#10084; by 
                <a href="https://tosinsoremekun.com" target="__blank" class="underline text-gray-900">Tosin Soremekun</a>
            </p>
        </footer>
    </div>
    <script src="js/app.js"></script>
</body>
</html>