<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Login - NSS Connect</title>
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
            <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center space-x-2">
                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">N</span>
                </div>
                <span class="font-bold text-2xl text-primary">NSS Connect</span>
            </a>
        </div>

        <div class="bg-card rounded-xl p-8 shadow-sm">
            <h1 class="text-2xl font-bold text-center mb-6">Welcome Back</h1>

            <?php if($errors->any()): ?>
                <div class="bg-error/10 border border-error/30 text-error px-4 py-3 rounded-lg mb-4">
                    <?php echo e($errors->first()); ?>

                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="email" class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="ml-2 text-sm text-secondarytext">Remember me</span>
                    </label>
                    <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-primary hover:underline">Forgot password?</a>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-2 rounded-lg font-semibold hover:bg-primary/90 transition">
                    Login
                </button>
            </form>

            <p class="text-center text-sm text-secondarytext mt-6">
                Don't have an account?
                <a href="<?php echo e(route('register')); ?>" class="text-primary hover:underline font-medium">Register</a>
            </p>
        </div>
    </div>
</body>
</html>
<?php /**PATH /workspaces/nss/resources/views/auth/login.blade.php ENDPATH**/ ?>