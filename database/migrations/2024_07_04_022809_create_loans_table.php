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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->bigInteger('amount');
            $table->date('Tgl_Pengajuan')->default(DB::raw('CURRENT_DATE'));
            $table->date('Tgl_Cair');
            $table->integer('Tenor');
            $table->bigInteger('jml_angsuran');
            $table->string('stat_loan')->default('dalam proses');

            $table->foreign('customer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
