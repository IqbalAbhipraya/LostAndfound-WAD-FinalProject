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
            $table->foreignId('commenter_id')->nullable()->index();
            $table->foreignId('lost_items_id')->nullable()->index();
            $table->foreignId('found_items_id')->nullable()->index();
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
