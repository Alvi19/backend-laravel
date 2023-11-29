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
        Schema::create('hutangs', function (Blueprint $table) {
            $table->id();
            $table->char('notransaksi', 10)->nullable();
            $table->char('kodespl', 10)->nullable();
            $table->dateTime('tglbeli');
            $table->integer('totalhutang');
            $table->timestamps();

            $table->foreign('notransaksi')->references('notransaksi')->on('hbelis')->cascadeOnDelete();
            $table->foreign('kodespl')->references('kodespl')->on('supliers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hutangs');
    }
};
