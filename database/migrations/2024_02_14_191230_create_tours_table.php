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
        Schema::create('tours', function (Blueprint $table) {
            $table->uuid('id')
                ->primary()
                ->unique();
            $table->foreignUuId('travelId')
                ->constrained('travels')
                ->onDelete('cascade');
            $table->string('name', 255);
            $table->date('startingDate');
            $table->date('endingDate');
            $table->unsignedInteger('price');
            $table->timestamps();

            $table->index('startingDate');
            $table->index('endingDate');
            $table->index('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
