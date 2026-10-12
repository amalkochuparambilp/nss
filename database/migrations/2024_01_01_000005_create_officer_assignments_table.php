<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('officer_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('nss_units')->onDelete('cascade');
            $table->foreignId('unit_id')->constrained('nss_units')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['user_id', 'unit_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('officer_assignments');
    }
};
