<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('nss_units')->onDelete('cascade');
            $table->foreignId('volunteer_id')->constrained('nss_units')->onDelete('cascade');
            $table->string('status')->default('registered');
            $table->timestamp('registered_at')->nullable();
            $table->integer('waitlist_position')->nullable();
            $table->timestamps();

            $table->unique(['event_id', 'volunteer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
