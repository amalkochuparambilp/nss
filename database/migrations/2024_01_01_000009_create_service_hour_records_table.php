<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_hour_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteer_id')->constrained('nss_units')->onDelete('cascade');
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('set null');
            $table->string('service_activity');
            $table->decimal('submitted_hours', 5, 2);
            $table->decimal('approved_hours', 5, 2)->nullable();
            $table->date('submission_date');
            $table->string('approval_status')->default('pending');
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('review_timestamp')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_hour_records');
    }
};
