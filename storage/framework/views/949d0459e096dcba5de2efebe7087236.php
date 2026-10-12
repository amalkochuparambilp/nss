<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
<section class="bg-primary text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                    Connect. Volunteer.<br>
                    <span class="text-accent">Transform.</span>
                </h1>
                <p class="text-white/80 text-lg mb-8">
                    NSS Connect is a centralized digital platform designed to simplify the management
                    of National Service Scheme activities across colleges and educational institutions.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="<?php echo e(route('register')); ?>" class="bg-accent text-white px-6 py-3 rounded-lg font-semibold hover:bg-accent/90 transition text-center">
                        Get Started
                    </a>
                    <a href="<?php echo e(route('about')); ?>" class="border border-white/30 text-white px-6 py-3 rounded-lg font-semibold hover:bg-white/10 transition text-center">
                        Learn More
                    </a>
                </div>
            </div>
            <div class="hidden lg:flex justify-center">
                <div class="w-96 h-96 bg-white/10 rounded-2xl flex items-center justify-center">
                    <svg class="w-48 h-48 text-white/30" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-primary mb-4">How NSS Connect Helps</h2>
            <p class="text-secondarytext max-w-2xl mx-auto">
                Streamlining NSS operations for volunteers, programme officers, and institutions.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-card rounded-xl p-8 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-lg mb-2">For Volunteers</h3>
                <p class="text-secondarytext">Register for events, track service hours, view achievements, and download certificates.</p>
            </div>
            <div class="bg-card rounded-xl p-8 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-accent/10 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-lg mb-2">For Programme Officers</h3>
                <p class="text-secondarytext">Manage events, record attendance, approve service hours, and issue certificates.</p>
            </div>
            <div class="bg-card rounded-xl p-8 shadow-sm hover:shadow-md transition">
                <div class="w-12 h-12 bg-success/10 rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-success" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-lg mb-2">For Institutions</h3>
                <p class="text-secondarytext">Manage NSS units, review reports, generate analytics, and maintain records.</p>
            </div>
        </div>
    </div>
</section>

<?php if($upcomingEvents->count() > 0): ?>
<section class="py-16 bg-card">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-bold text-primary">Upcoming Events</h2>
            <a href="<?php echo e(route('events')); ?>" class="text-primary hover:underline font-medium">View All</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $upcomingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-surface rounded-xl p-6 shadow-sm hover:shadow-md transition">
                    <div class="text-xs font-semibold text-accent uppercase mb-2"><?php echo e($event->category); ?></div>
                    <h3 class="font-semibold text-lg mb-2"><?php echo e($event->title); ?></h3>
                    <p class="text-secondarytext text-sm mb-4"><?php echo e(Str::limit($event->description, 100)); ?></p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-secondarytext"><?php echo e($event->start_date->format('M d, Y')); ?></span>
                        <a href="<?php echo e(route('event-details', $event)); ?>" class="text-primary font-medium text-sm hover:underline">Details</a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold text-primary mb-4">Join NSS Connect Today</h2>
        <p class="text-secondarytext max-w-2xl mx-auto mb-8">
            Be part of a community dedicated to service, learning, and transformation.
        </p>
        <a href="<?php echo e(route('register')); ?>" class="bg-primary text-white px-8 py-3 rounded-lg font-semibold hover:bg-primary/90 transition">
            Create Account
        </a>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/nss/resources/views/public/home.blade.php ENDPATH**/ ?>