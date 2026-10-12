<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'NSS Connect'); ?> - Powered by Devzoft</title>
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
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">N</span>
                        </div>
                        <span class="font-bold text-xl text-primary">NSS Connect</span>
                    </a>
                    <div class="hidden md:flex items-center ml-10 space-x-8">
                        <a href="<?php echo e(route('home')); ?>" class="text-secondarytext hover:text-primary transition">Home</a>
                        <a href="<?php echo e(route('about')); ?>" class="text-secondarytext hover:text-primary transition">About</a>
                        <a href="<?php echo e(route('events')); ?>" class="text-secondarytext hover:text-primary transition">Events</a>
                        <a href="<?php echo e(route('impact')); ?>" class="text-secondarytext hover:text-primary transition">Impact</a>
                        <a href="<?php echo e(route('contact')); ?>" class="text-secondarytext hover:text-primary transition">Contact</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition">Dashboard</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-secondarytext hover:text-primary transition">Login</a>
                        <a href="<?php echo e(route('register')); ?>" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-primary text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="font-bold text-lg mb-4">NSS Connect</h3>
                    <p class="text-white/70 text-sm">Connect. Volunteer. Transform.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-white/70 text-sm">
                        <li><a href="<?php echo e(route('about')); ?>" class="hover:text-white transition">About</a></li>
                        <li><a href="<?php echo e(route('events')); ?>" class="hover:text-white transition">Events</a></li>
                        <li><a href="<?php echo e(route('impact')); ?>" class="hover:text-white transition">Impact Stories</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-white/70 text-sm">
                        <li><a href="<?php echo e(route('contact')); ?>" class="hover:text-white transition">Contact Us</a></li>
                        <li><a href="<?php echo e(route('privacy')); ?>" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="<?php echo e(route('terms')); ?>" class="hover:text-white transition">Terms of Service</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <p class="text-white/70 text-sm">info@nssconnect.com</p>
                    <p class="text-white/70 text-sm">Powered by Devzoft</p>
                </div>
            </div>
            <div class="border-t border-white/20 mt-8 pt-8 text-center text-white/50 text-sm">
                <p>&copy; <?php echo e(date('Y')); ?> NSS Connect. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
<?php /**PATH /workspaces/nss/resources/views/layouts/public.blade.php ENDPATH**/ ?>