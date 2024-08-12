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
        Schema::table('mandatory_savings', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);

            // Re-add the correct foreign key
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mandatory_savings', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);

            // Re-add the incorrect foreign key for rollback
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
