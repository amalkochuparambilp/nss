@extends('layouts.public')

@section('title', 'Privacy Policy')

@section('content')
<section class="bg-primary text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-4">Privacy Policy</h1>
    </div>
</section>

<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 prose prose-primary">
        <div class="bg-card rounded-xl p-8 shadow-sm">
            <p class="text-secondarytext mb-4">Last updated: {{ date('F d, Y') }}</p>

            <h2 class="text-xl font-bold text-primary mt-6 mb-3">1. Information We Collect</h2>
            <p class="text-secondarytext">
                We collect information you provide during registration, including name, email address,
                phone number, academic information, and emergency contact details.
            </p>

            <h2 class="text-xl font-bold text-primary mt-6 mb-3">2. How We Use Your Information</h2>
            <p class="text-secondarytext">
                Your information is used to manage NSS activities, track participation, issue certificates,
                and communicate important updates about events and service opportunities.
            </p>

            <h2 class="text-xl font-bold text-primary mt-6 mb-3">3. Data Protection</h2>
            <p class="text-secondarytext">
                We implement appropriate security measures to protect your personal information.
                Data is stored securely and access is restricted to authorized personnel only.
            </p>

            <h2 class="text-xl font-bold text-primary mt-6 mb-3">4. Data Sharing</h2>
            <p class="text-secondarytext">
                We do not share your personal information with third parties except as required by law
                or as necessary for NSS administrative purposes.
            </p>

            <h2 class="text-xl font-bold text-primary mt-6 mb-3">5. Your Rights</h2>
            <p class="text-secondarytext">
                You have the right to access, correct, or request deletion of your personal information.
                Contact your institution's Programme Officer for assistance.
            </p>

            <h2 class="text-xl font-bold text-primary mt-6 mb-3">6. Contact</h2>
            <p class="text-secondarytext">
                For privacy-related inquiries, please contact your institution's NSS Programme Officer
                or email info@nssconnect.com.
            </p>
        </div>
    </div>
</section>
@endsection
