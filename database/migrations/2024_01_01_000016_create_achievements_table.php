<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteer_id')->constrained('nss_units')->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->date('earned_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
