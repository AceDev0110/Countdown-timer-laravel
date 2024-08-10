<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <section class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold mb-2 pb-2">Countdown Timer</h1>
            <img src="https://cdn.shopify.com/app-store/listing_images/8c2113193afda0376534f7e30d691899/icon/CMqejL_0lu8CEAE=.jpg" class="w-full h-auto rounded-lg" alt="Countdown Timer">
        </div>
        <div class="text-center mb-6">
            <p class="text-lg font-semibold">Sign in with</p>
        </div>
        <div class="flex justify-center space-x-4 mb-6">
            <a href="{{ route('auth.socialite.redirect', 'google') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fab fa-google fa-2x"></i>
            </a>
            <a href="{{ route('auth.socialite.redirect', 'twitter') }}" class="text-gray-600 hover:text-gray-800">
                <i class="fab fa-twitter fa-2x"></i>
            </a>
        </div>
        <div class="flex items-center justify-center mb-6">
            <div class="flex-grow border-t border-gray-300"></div>
            <p class="px-3 text-gray-600">Or</p>
            <div class="flex-grow border-t border-gray-300"></div>
        </div>
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            <div class="text-center">
                <a href="/login/guest" class="text-blue-600 hover:underline">Guest Mode</a>
            </div>
            <!-- Additional input fields can be placed here -->
        </form>
    </section>

    <!-- FontAwesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>