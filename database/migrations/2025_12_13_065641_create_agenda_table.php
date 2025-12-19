<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->id('id_agenda');
            $table->string('judul');
            $table->text('deskripsi');
            $table->dateTime('tgl_mulai');
            $table->dateTime('tgl_selesai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda');
    }
};
