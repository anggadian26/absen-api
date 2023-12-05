<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ijin', function (Blueprint $table) {
            $table->id();
            $table->date('date_from');
            $table->time('time_from');
            $table->date('date_to');
            $table->time('time_to');
            $table->text('keterangan')->nullable();
            $table->integer('user_id');
            $table->enum('flg', ['P', 'A', 'R']);   // P = Pending; A = Approved; R = Rejected
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ijin');
    }
};
