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
        Schema::create('fashions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug');
            $table->string('image')->nullable();
            $table->text('other_photos')->nullable();
            $table->text('description')->nullable();
            $table->json('colors')->nullable();
            $table->text('price')->nullable();
//            $table->json('sizes')->nullable();
            $table->string('status')
                ->comment('not available, available, sold')
                ->nullable();

            $table->foreignId('user_id')
                ->comment('The user who created the fashion item')
                ->nullable()->constrained()
                ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fashions');
    }
};
