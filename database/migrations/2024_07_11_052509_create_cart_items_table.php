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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('cart_id');
            // $table->foreign('cart_id')->refrencing('id')->on('carts');
            $table->foreignId('cart_id')->constrained(
                table:'carts',indexName:'id'
            )->onDelete('cascade');
            // $table->unsignedBigInteger('book_id');
            // $table->foreign('book_id')->refrencing('id')->on('books');
            $table->foreignId('book_id')->constrained(table:'books',indexName:'id')->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
