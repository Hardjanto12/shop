<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        // Schema::create('products', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('serial_number')->unique();
        //     $table->string('item');
        //     $table->text('description')->nullable();
        //     $table->decimal('price', 8, 2);
        //     $table->foreignId('category_id');
        //     $table->timestamps();
        // });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_serial_number');
            $table->string('item');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->foreignId('category_id');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
