<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index()->unique();
            $table->foreignId('jenis_dokumen_id');
            $table->foreignId('created_by');
            $table->string('judul');
            $table->longText('deskripsi')->nullable();
            $table->string('nama_file')->nullable();
            $table->string('slug')->nullable();
            $table->date('tanggal_posting')->nullable();
            $table->timestamps();

            $table->foreign('jenis_dokumen_id')->references('id')->on('jenis_dokumens')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumens');
    }
}
