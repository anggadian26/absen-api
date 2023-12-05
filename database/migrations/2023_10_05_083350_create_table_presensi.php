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
        Schema::create('presensi', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->decimal('latitude', 12,5)->nullable();
            $table->decimal('longitude', 12,5)->nullable();
            $table->date('tanggal')->nullable();
            $table->time('masuk')->nullable();
            $table->time('pulang')->nullable();
            $table->enum('flg', ['P', 'I', 'S', 'N'])->default('P');
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
        Schema::dropIfExists('table_presensi');
    }
};
