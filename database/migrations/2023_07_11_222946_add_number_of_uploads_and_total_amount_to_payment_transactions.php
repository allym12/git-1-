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
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->string('payment_phone')->nullable()->index()->after('user_id');
            $table->integer('number_of_uploads')->default(0)->nullable()->index()->after('payment_phone');
            $table->integer('total_amount')->default(0)->nullable()->index()->after('number_of_uploads');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_transactions', function (Blueprint $table) {
            $table->dropColumn('payment_phone');
            $table->dropColumn('number_of_uploads');
            $table->dropColumn('total_amount');
        });
    }
};
