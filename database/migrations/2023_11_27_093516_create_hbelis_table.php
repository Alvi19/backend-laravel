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
        Schema::create('hbelis', function (Blueprint $table) {
            $table->id();
            $table->char('notransaksi', 10)->unique();
            $table->char('kodespl', 10)->nullable();
            $table->dateTime('tglbeli');
            $table->timestamps();

            $table->foreign('kodespl')->references('kodespl')->on('supliers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hbelis');
    }
};
