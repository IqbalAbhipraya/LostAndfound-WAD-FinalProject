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
        Schema::create('found_item', function (Blueprint $table) {
            $table->id();
            $table->string('itemname');
            $table->text('description')->nullable();
            $table->date('found_date');
            $table->string('location');
            $table->string('image');
            $table->string('founderid');
            $table->string('founder_name');
            $table->string('founder_contact');
            $table->enum('claim_status', ['unclaimed', 'claimed'])->default('unclaimed');
            $table->timestamp('claimed_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('found_item');
    }
};
