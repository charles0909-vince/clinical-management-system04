<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
            $table->dateTime('prescription_date');
            $table->string('diagnosis');
            $table->json('medications'); 
            $table->text('instructions');
            $table->text('notes')->nullable();
            $table->enum('status', ['active', 'completed', 'cancelled']);
            $table->timestamps();
        });
    }
    

    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
