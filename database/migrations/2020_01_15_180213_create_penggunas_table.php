<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePenggunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('nama', 50);
            $table->string('email', 50);
            $table->string('telepon', 15);
            $table->string('sandi', 64)->default(md5(md5('12345678')));
            $table->string('alamat', 191);
            $table->enum('jenis_kelamin', ['perempuan','laki-laki'])->nullable();
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->string('id_line', 50)->nullable();
            $table->enum('role', ['admin','volunteer']);
        });
        Schema::create('event', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('judul', 50);
            $table->dateTime('tanggal_pelaksanaan');
            $table->text('deskripsi');
            $table->string('thumbnail', 191);
            $table->string('jenis_event', 20);
        });
        Schema::create('posting_kegiatan', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('pengguna_id')->unsigned();
            $table->foreign('pengguna_id')->references('id')->on('pengguna')->onDelete('cascade');
            $table->string('judul', 50);
            $table->text('deskripsi');
            $table->string('thumbnail', 191);
            $table->timestamp('tanggal_posting')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
        Schema::create('donasi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis_donasi', 100);
            $table->text('deskripsi');
        });
        Schema::create('peserta_event', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('event_id')->unsigned();
            $table->integer('pengguna_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
            $table->foreign('pengguna_id')->references('id')->on('pengguna')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengguna');
        Schema::dropIfExists('event');
        Schema::dropIfExists('posting_kegiatan');
        Schema::dropIfExists('donasi');
        Schema::dropIfExists('peserta_event');
    }
}
