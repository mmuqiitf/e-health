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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('medical_record_id')->unique();
            $table->string('nik', 16)->unique();
            $table->string('birth_place');
            $table->date('birthday');
            $table->enum('gender', ['Male', 'Female'])->default('Male');
            $table->text('address');
            $table->enum('religion', ['Islam', 'Christian', 'Catholic', 'Hindu', 'Buddha', 'Konghucu', 'Others'])->default('Islam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
