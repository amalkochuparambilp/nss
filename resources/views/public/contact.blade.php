@extends('layouts.public')

@section('title', 'Contact')

@section('content')
<section class="bg-primary text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold mb-4">Contact Us</h1>
        <p class="text-white/80 text-lg">Get in touch with the NSS Connect team.</p>
    </div>
</section>

<section class="py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-card rounded-xl p-8 shadow-sm">
                <h2 class="text-xl font-bold text-primary mb-4">Send a Message</h2>
                <form action="#" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Name</label>
                        <input type="text" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Email</label>
                        <input type="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Message</label>
                        <textarea rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                    </div>
                    <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary/90 transition">
                        Send Message
                    </button>
                </form>
            </div>
            <div class="space-y-6">
                <div class="bg-card rounded-xl p-6 shadow-sm">
                    <h3 class="font-semibold text-primary mb-2">Email</h3>
                    <p class="text-secondarytext">info@nssconnect.com</p>
                </div>
                <div class="bg-card rounded-xl p-6 shadow-sm">
                    <h3 class="font-semibold text-primary mb-2">Support Hours</h3>
                    <p class="text-secondarytext">Monday - Friday: 9:00 AM - 5:00 PM IST</p>
                </div>
                <div class="bg-card rounded-xl p-6 shadow-sm">
                    <h3 class="font-semibold text-primary mb-2">Powered by</h3>
                    <p class="text-secondarytext">Devzoft</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
