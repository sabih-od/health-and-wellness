<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('book_sessions', function (Blueprint $table) {
            $table->integer('session_timing_id')->nullable();
            $table->dropColumn('service_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_sessions', function (Blueprint $table) {
            $table->integer('service_id')->nullable();
            $table->dropColumn('session_timing_id');
        });

    }
};
