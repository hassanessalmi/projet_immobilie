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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('clients');
            $table->string('Details');
            $table->unsignedInteger('ApartmentsID');
            $table->unsignedBigInteger('commercial');
            $table->decimal('finalPrice');
            // Foreign key references
            $table->foreign('clients')->references('id')->on('clients');
            $table->foreign('ApartmentsID')->references('ApartmentsID')->on('apartements');
            $table->foreign('commercial')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
