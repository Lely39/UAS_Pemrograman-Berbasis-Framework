<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('elektronik_id')
                  ->constrained('elektroniks')
                  ->onDelete('cascade');

            $table->string('nama_pemesan');
            $table->text('alamat');
            $table->integer('jumlah_pesanan');

            // ENUM metode pembayaran
            $table->enum('metode_pembayaran', [
                'transfer_bank',
                'e_wallet',
                'cod'
            ]);

            // ENUM status pembayaran
            $table->enum('setatus_pembayaran', [
                'menunggu',
                'dibayar',
                'gagal'
            ])->default('menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
