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
        Schema::create('travels', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('slug', 255);
            $table->string('name', 255);
            $table->text('description');
            $table->unsignedInteger('numberOfDays');
            $table->boolean('public')->default(false);
            $table->json('moods');
            $table->timestamps();

            $table->index('slug');
            $table->index('public');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travels');
    }
};
