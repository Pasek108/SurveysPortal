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
            $table->foreignId('owner_id')->constrained('users');
            $table->string('edit_password', 60);
            $table->string('access_password', 60)->nullable()->default(null);
            $table->timestamp('start_date')->nullable()->default(null);
            $table->timestamp('end_date')->nullable()->default(null);
            $table->string('title', 300);
            $table->string('description', 1200)->nullable();
            $table->string('end_message', 500)->nullable();
            $table->boolean('allow_not_logged');
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
