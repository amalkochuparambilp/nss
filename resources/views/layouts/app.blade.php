<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'NSS Connect') - Powered by Devzoft</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
                        success: '#16803C',
                        warning: '#B54708',
                        error: '#B42318',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-surface text-maintext font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <aside class="hidden lg:flex lg:flex-col w-64 bg-primary text-white">
            <div class="p-6">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <span class="font-bold text-lg">N</span>
                    </div>
                    <span class="font-bold text-lg">NSS Connect</span>
                </a>
            </div>
            <nav class="flex-1 px-4 space-y-1">
                @yield('sidebar')
            </nav>
            <div class="p-4 border-t border-white/20">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="text-sm font-medium">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-white/60 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="w-full text-left text-sm text-white/70 hover:text-white transition">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm lg:hidden">
                <div class="flex items-center justify-between px-4 py-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">N</span>
                        </div>
                        <span class="font-bold text-primary">NSS Connect</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-secondarytext text-sm">Logout</button>
                    </form>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 lg:p-8">
                @if(session('success'))
                    <div class="bg-success/10 border border-success/30 text-success px-4 py-3 rounded-lg mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-error/10 border border-error/30 text-error px-4 py-3 rounded-lg mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
