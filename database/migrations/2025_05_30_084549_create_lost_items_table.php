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
        Schema::create('lost_items', function (Blueprint $table) {
            $table->id();
            $table->string('itemname');
            $table->text('description')->nullable();
            $table->date('lost_date')->default(now());
            $table->string('location');
            $table->string('image')->nullable();
            $table->foreignId('userid'); // foreign key to users table
            $table->string('lost_name');
            $table->string('lost_contact');
            $table->enum('claim_status', ['unclaimed', 'claimed'])->default('unclaimed');
            $table->timestamp('claimed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_items');
    }
};