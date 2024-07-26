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
        Schema::create('neraca', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->string('ref');
            $table->string('akunneraca');
            $table->decimal('totaldebit', 15, 2);
            $table->decimal('totalkredit', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neraca');
    }
};