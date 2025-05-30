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
        //
        Schema::create('return_report', function (Blueprint $table) {
            $table->id();
            $table->foreignId('found_item_id')->nullable()->index();
            $table->foreignId('founder_id')->nullable()->index();
            $table->string('owner_name');
            $table->string('condition');
            $table->string('image');
            $table->timestamps();
            $table->enum('admin_acc', ['yes', 'no', 'pending'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
