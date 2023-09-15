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
        Schema::create('clients', function (Blueprint $table) {
            $table->id(); // Assuming you want an auto-incrementing primary key
            $table->string('token')->unique()->default('RF' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT));
            
            // Other columns
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('tele');
            $table->unsignedBigInteger('commercial');
            $table->foreign('commercial')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
