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
        Schema::create('generated_barcodes', function (Blueprint $table) {
            $table->id();
            $table->string('barcodeId');
            $table->string('image')->nullable();
            $table->string('productCode');
            $table->string('countryCode');
            $table->string('companyCode');
            $table->string('status')->default('created');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generated_barcodes');
    }
};
