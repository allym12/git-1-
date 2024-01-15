<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->mediumText('description')->nullable();
            $table->string('price')->nullable();
            $table->string('status')
                ->comment('not available, available, sold')
                ->nullable();
            $table->string('type')
                ->comment('rent, sale')
                ->nullable();
            $table->string('condition')
                ->comment('new, used')
                ->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();

            $table->string('year')->nullable();
            $table->string('transmission')->nullable();
            $table->json('car_options')->nullable();
            $table->foreignId('user_id')
                ->comment('user who created the house')
                ->nullable();
            $table->string('image')->nullable();
            $table->text('other_photos')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
