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
        Schema::create('water', function (Blueprint $table) {
            $table->id();
            $table->double('number');
            $table->date('date');
            $table->text('comment')->nullable();
            $table->timestamps(); // optional; remove if not needed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water');
    }
};
