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
        Schema::create('apartements', function (Blueprint $table) {
            $table->increments('ApartmentsID');
            $table->string('ApartmentsNumber');
            $table->integer('SizeParSquareMeter');
            $table->decimal('PriceParSquareMeter', 8, 2);
            $table->decimal('TotalPrice', 10, 2);
            $table->enum('Status', ['Available', 'Sold', 'Reserved']);
            $table->unsignedInteger('ResidenceID');
            $table->foreign('ResidenceID')->references('ResidenceID')->on('residences');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartements');
    }
};
