<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->nullable()->constrained('nss_units')->onDelete('cascade');
            $table->foreignId('unit_id')->nullable()->constrained('nss_units')->onDelete('cascade');
            $table->foreignId('event_id')->nullable()->constrained('nss_units')->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->foreignId('published_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_pinned')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
