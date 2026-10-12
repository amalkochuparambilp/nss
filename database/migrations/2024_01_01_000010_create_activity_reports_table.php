<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('nss_units')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('volunteer_profiles')->onDelete('cascade');
            $table->string('title');
            $table->date('activity_date');
            $table->string('venue')->nullable();
            $table->text('objectives')->nullable();
            $table->text('description');
            $table->integer('participant_count')->default(0);
            $table->text('outcomes')->nullable();
            $table->text('challenges')->nullable();
            $table->string('review_status')->default('draft');
            $table->text('reviewer_comments')->nullable();
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_reports');
    }
};
