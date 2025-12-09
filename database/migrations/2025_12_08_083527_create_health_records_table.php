<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('health_records', function (Blueprint $table) {
        $table->id();
        $table->foreignId('resident_id')->constrained()->onDelete('cascade');
        $table->date('record_date');
        $table->string('temperature')->nullable();
        $table->string('blood_pressure')->nullable();
        $table->decimal('weight', 5, 2)->nullable();
        $table->decimal('height', 5, 2)->nullable();
        $table->text('symptoms')->nullable();
        $table->text('diagnosis')->nullable();
        $table->text('medications')->nullable();
        $table->text('notes')->nullable();
        $table->foreignId('recorded_by')->constrained('users');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};
