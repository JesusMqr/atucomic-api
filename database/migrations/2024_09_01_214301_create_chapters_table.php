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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->float('order_number');
            $table->string('image_url')->nullable();
            $table->foreignId('owner_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('serie_id')->constrained('series')->cascadeOnDelete();$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
