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
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('last_name');
        $table->enum('gender', ['Male', 'Female', 'Other']);
        $table->string('education');
        $table->text('address');
        $table->unsignedBigInteger('phone_number');
        $table->string('profile_picture')->nullable();
        $table->json('documents')->nullable(); // To store multiple documents
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
