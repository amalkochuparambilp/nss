<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('nss_units')->onDelete('cascade');
            $table->foreignId('volunteer_id')->constrained('nss_units')->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->text('remarks')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('finalized_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('finalized_at')->nullable();
            $table->timestamps();

            $table->unique(['event_id', 'volunteer_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
