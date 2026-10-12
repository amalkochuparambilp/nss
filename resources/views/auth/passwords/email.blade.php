<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password - NSS Connect</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#173B70',
                        accent: '#E53935',
                        surface: '#F7F9FC',
                        card: '#FFFFFF',
                        maintext: '#172033',
                        secondarytext: '#667085',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-surface text-maintext font-sans antialiased min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md px-4">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center space-x-2">
                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">N</span>
                </div>
                <span class="font-bold text-2xl text-primary">NSS Connect</span>
            </a>
        </div>

        <div class="bg-card rounded-xl p-8 shadow-sm">
            <h1 class="text-2xl font-bold text-center mb-6">Forgot Password</h1>

            @if(session('status'))
                <div class="bg-success/10 border border-success/30 text-success px-4 py-3 rounded-lg mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <p class="text-secondarytext text-sm mb-4">Enter your email address and we'll send you a password reset link.</p>

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg font-semibold hover:bg-primary/90 transition">
                    Send Reset Link
                </button>
            </form>

            <p class="text-center text-sm text-secondarytext mt-6">
                Remember your password?
                <a href="{{ route('login') }}" class="text-primary hover:underline font-medium">Login</a>
            </p>
        </div>
    </div>
</body>
</html>
