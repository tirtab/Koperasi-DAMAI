<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixForeignKeyInLoansTable extends Migration
{
    public function up()
    {
        Schema::table('loans', function (Blueprint $table) {
            // Drop the incorrect foreign key
            $table->dropForeign(['customer_id']);

            // Re-add the correct foreign key
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('loans', function (Blueprint $table) {
            // Drop the correct foreign key if rolling back
            $table->dropForeign(['customer_id']);

            // Re-add the incorrect foreign key for rollback
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
