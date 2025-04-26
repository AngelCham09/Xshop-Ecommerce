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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->dropForeign(['delivery_method_id']);
            $table->dropColumn('delivery_method_id');
            $table->foreignId('delivery_method_id')
                ->nullable()
                ->constrained('delivery_methods')
                ->onDelete('cascade')
                ->after('session_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade')->after('session_id');

            $table->dropForeign(['delivery_method_id']);
            $table->dropColumn('delivery_method_id');
            $table->foreignId('delivery_method_id')->nullable()->constrained('delivery_methods')->onDelete('cascade')->after('user_address_id');
        });
    }
};
