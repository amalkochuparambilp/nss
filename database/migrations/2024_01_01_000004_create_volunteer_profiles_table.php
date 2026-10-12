<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('volunteer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('nss_units')->onDelete('cascade');
            $table->foreignId('institution_id')->constrained('nss_units')->onDelete('cascade');
            $table->foreignId('unit_id')->nullable()->constrained('nss_units')->onDelete('set null');
            $table->string('enrollment_number')->nullable()->unique();
            $table->string('full_name');
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone', 15)->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pincode', 10)->nullable();
            $table->string('course')->nullable();
            $table->string('department')->nullable();
            $table->string('year_of_study')->nullable();
            $table->string('academic_year')->nullable();
            $table->string('blood_group', 5)->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone', 15)->nullable();
            $table->string('status')->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('volunteer_profiles');
    }
};
