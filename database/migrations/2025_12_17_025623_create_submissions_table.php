<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('form_type');
            
            // Common fields
            $table->string('applicant_name');
            $table->string('applicant_ic');
            $table->string('phone');
            $table->text('address');
            
            // Optional fields (nullable)
            $table->string('participant_name')->nullable();
            $table->string('participant_ic')->nullable();
            $table->string('package_type')->nullable();
            $table->string('animal_type')->nullable();
            $table->string('quantity')->nullable();
            $table->string('relationship')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
            
            $table->index(['user_id', 'form_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
