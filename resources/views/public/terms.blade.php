@import('layouts.public')

@section('title', 'Terms of Service')

@section('content')
<section class="bg-primary text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-4">Terms of Service</h1>
    </div>
</section>

<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 prose prose-primary">
        <div class="bg-card rounded-xl p-8 shadow-sm">
            <p class="text-secondarytext mb-4">Last updated: {{ date('F d, Y') }}</p>

            <h2 class="text-xl font-bold text-primary mt-6 mb-3">1. Acceptance of Terms</h2>
            <p class="text-secondarytext">
                By accessing and using NSS Connect, you agree to these terms of service. If you do not agree,
                please do not use the platform.
            </p>

            <h2 class="text-xl font-bold text-primary mt-6 mb-3">2. User Accounts</h2>
            <p class="text-secondarytext">
                You are responsible for maintaining the confidentiality of your account credentials.
                You must provide accurate information during registration and keep your profile updated.
            </p>

            <h2 class="text-xl font-bold text-primary mt-6 mb-3">3. Appropriate Use</h2>
            <p class="text-secondarytext">
                You agree to use NSS Connect only for lawful purposes and in accordance with NSS guidelines.
                Misuse of the platform may result in account suspension.
            </p>

            <h2 class="text-xl font-bold text-primary mt-6 mb-3">4. Content</h2>
            <p class="text-secondarytext">
                Users are responsible for content they upload or submit. NSS Connect reserves the right
                to remove inappropriate content.
            </p>

            <h2 class="text-xl font-bold text-primary mt-6 mb-3">5. Limitation of Liability</h2>
            <p class="text-secondarytext">
                NSS Connect is provided "as is" without warranties. We are not liable for any damages
                arising from the use of this platform.
            </p>

            <h2 class="text-xl font-bold text-primary mt-6 mb-3">6. Changes to Terms</h2>
            <p class="text-secondarytext">
                We may update these terms from time to time. Continued use of the platform constitutes
                acceptance of updated terms.
            </p>
        </div>
    </div>
</section>
@endsection
