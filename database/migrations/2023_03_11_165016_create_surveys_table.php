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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->foreignId('owner_id')->constrained('users');
            $table->string('edit_password', 32);
            $table->string('access_password', 32);
            $table->timestamp('start_date')->nullable()->default(null);;
            $table->timestamp('end_date')->nullable()->default(null);;
            $table->string('title', 300);
            $table->string('description', 1200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
