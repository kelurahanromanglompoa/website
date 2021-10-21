<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasis', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index()->unique();
            $table->foreignId('jenis_informasi_id');
            $table->foreignId('created_by');
            $table->boolean('is_headline')->default(0);
            $table->string('judul');
            $table->longText('deskripsi');
            $table->string('cover')->nullable();
            $table->string('slug')->nullable();
            $table->date('tanggal_posting')->nullable();
            $table->integer('viewers')->default(0);
            $table->timestamps();

            $table->foreign('jenis_informasi_id')->references('id')->on('jenis_informasis')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('informasis');
    }
}
