<?php $__env->startSection('title', 'About'); ?>

<?php $__env->startSection('content'); ?>
<section class="bg-primary text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-4">About NSS Connect</h1>
        <p class="text-white/80 text-lg max-w-2xl">
            A centralized digital platform for managing National Service Scheme activities across colleges and educational institutions.
        </p>
    </div>
</section>

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <h2 class="text-2xl font-bold text-primary mb-4">Our Vision</h2>
                <p class="text-secondarytext mb-6">
                    Make NSS administration simpler, volunteer participation more accessible, and community-service
                    outcomes easier to document and understand.
                </p>
                <h2 class="text-2xl font-bold text-primary mb-4">Our Mission</h2>
                <p class="text-secondarytext">
                    Connect volunteers and institutions through a reliable digital platform that supports the planning,
                    execution, documentation, and reporting of community-service activities.
                </p>
            </div>
            <div class="bg-card rounded-xl p-8 shadow-sm">
                <h3 class="font-semibold text-lg text-primary mb-4">Key Features</h3>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-success mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-secondarytext">Volunteer enrollment and profile management</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-success mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-secondarytext">Event discovery and registration</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-success mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-secondarytext">Attendance tracking and verification</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-success mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-secondarytext">Service-hour submission and approval</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-success mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-secondarytext">Activity reporting and documentation</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-success mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-secondarytext">Certificate management</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-card">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl font-bold text-primary mb-4">Powered by Devzoft</h2>
        <p class="text-secondarytext max-w-2xl mx-auto">
            NSS Connect is developed and maintained by Devzoft, committed to building technology solutions
            that make a difference in education and community service.
        </p>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /workspaces/nss/resources/views/public/about.blade.php ENDPATH**/ ?>