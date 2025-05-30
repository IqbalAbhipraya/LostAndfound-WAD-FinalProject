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
        Schema::create('comment_table', function (Blueprint $table) {
            $table->id(); 
            // foreign key ke tabel users (untuk siapa yang membuat komentar)
            $table->unsignedBigInteger('commenter_id');
            $table->foreign('commenter_id')->references('id')->on('users')->onDelete('cascade');

            // foreign key ke tabel lost_items (jika komentar untuk barang hilang)
            $table->unsignedBigInteger('lost_items_id')->nullable();
            $table->foreign('lost_items_id')->references('id')->on('lost_items')->onDelete('cascade');

            // foreign key ke tabel found_items (jika komentar untuk barang ditemukan)
            $table->unsignedBigInteger('found_items_id')->nullable();
            $table->foreign('found_items_id')->references('id')->on('found_items')->onDelete('cascade');

            $table->text('comments');

            $table->timestamps(); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_table');
    }
};