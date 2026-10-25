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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id_product');
            $table->unsignedInteger('id_user');
            $table->string('nama_produk', 100);
            $table->string('merek', 100)->nullable();
            $table->string('bahan_aktif', 255)->nullable();
            $table->enum('jenis_produk', ['Cleanser', 'Toner', 'Serum', 'Moisturizer', 'Sunscreen', 'Masker', 'Exfoliator', 'Other'])->nullable();
            $table->enum('jadwal_pemakaian', ['Siang', 'Malam', 'Siang dan Malam'])->nullable();
            $table->enum('status_pemakaian', ['Aktif', 'Tidak Aktif'])->nullable();
            $table->text('catatan_product')->nullable();

            $table->foreign('id_user')->references('id_user')->on('users');
        });

        Schema::create('jurnal', function (Blueprint $table) {
            $table->increments('id_jurnal');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_product')->nullable();
            $table->dateTime('tanggal_pemakaian');
            $table->string('kondisi_kulit', 50)->nullable();
            $table->enum('jadwal_pemakaian', ['Siang', 'Malam'])->nullable();
            $table->text('catatan_jadwal')->nullable();

            $table->foreign('id_user')->references('id_user')->on('users');
            $table->foreign('id_product')->references('id_product')->on('product');
        });

        Schema::create('urutan_skincare', function (Blueprint $table) {
            $table->increments('id_urutan');
            $table->unsignedInteger('id_user');
            $table->date('tanggal_diubah');
            $table->text('detail_urutan');

            $table->foreign('id_user')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal');
        Schema::dropIfExists('product');
        Schema::dropIfExists('urutan_skincare');
    }
};
