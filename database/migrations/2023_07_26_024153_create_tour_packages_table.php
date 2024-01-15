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
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_title')->nullable();
            $table->string('slug')->nullable();
            $table->text('package_description')->nullable();
            $table->string('status')
                ->comment('not available, available, sold')
                ->nullable();
            $table->string('image')->nullable();
            $table->text('other_photos')->nullable();
            $table->string('package_location')
                ->comment('district')
                ->nullable();
            $table->string('package_price')->nullable();
            $table->string('package_duration')->nullable();
            $table->mediumText('itinerary')->nullable();
            $table->foreignId('user_id')
                ->comment('The user who created the tour package')
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
        Schema::dropIfExists('tour_packages');
    }
};
