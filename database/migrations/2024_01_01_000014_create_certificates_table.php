<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipient_id')->constrained('volunteer_profiles')->onDelete('cascade');
            $table->foreignId('issuer_id')->constrained('users')->onDelete('cascade');
            $table->string('certificate_type');
            $table->foreignId('event_id')->nullable()->constrained()->onDelete('set null');
            $table->date('issue_date');
            $table->string('reference_number')->unique();
            $table->string('status')->default('issued');
            $table->string('document_path')->nullable();
            $table->timestamp('revoked_at')->nullable();
            $table->text('revocation_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
