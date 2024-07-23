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
        Schema::create('kasmasuk', function (Blueprint $table) {
            $table->id();
            $table->date('tgl');
            $table->string('no_kasmasuk');
            $table->string('deskripsi');
            $table->string('no_bukti');
            $table->string('sumber');
            $table->decimal('jumlah', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kasmassuk');
    }
};
