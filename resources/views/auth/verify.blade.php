<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify Email - NSS Connect</title>
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
            <h1 class="text-2xl font-bold text-center mb-6">Verify Your Email</h1>

            @if(session('verification-link-sent'))
                <div class="bg-success/10 border border-success/30 text-success px-4 py-3 rounded-lg mb-4">
                    A new verification link has been sent to your email address.
                </div>
            @endif

            <p class="text-secondarytext text-center mb-6">
                Before proceeding, please check your email for a verification link.
                If you did not receive the email, click below to request another.
            </p>

            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg font-semibold hover:bg-primary/90 transition">
                    Resend Verification Link
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="w-full text-secondarytext hover:text-primary transition">
                    Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html>
