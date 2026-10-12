<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('institution_id')->constrained('nss_units')->onDelete('cascade');
            $table->foreignId('unit_id')->nullable()->constrained('nss_units')->onDelete('set null');
            $table->string('title');
            $table->text('description');
            $table->string('category');
            $table->string('cover_image')->nullable();
            $table->string('venue')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('registration_deadline')->nullable();
            $table->integer('capacity')->default(0);
            $table->text('eligibility_conditions')->nullable();
            $table->string('visibility')->default('public');
            $table->string('status')->default('draft');
            $table->string('registration_status')->default('open');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
