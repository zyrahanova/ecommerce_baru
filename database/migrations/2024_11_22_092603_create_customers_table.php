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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name'); // Nama Lengkap
            $table->enum('gender', ['male', 'female', 'other']); // Jenis Kelamin
            $table->string('email')->unique(); // Email (Unique)
            $table->string('phone_number'); // No Hp
            $table->text('address'); // Alamat
            $table->string('profile_picture')->nullable(); // Photo Profil (opsional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
