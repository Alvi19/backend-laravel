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
        Schema::create('dbelis', function (Blueprint $table) {
            try {
                $table->id();
                $table->char('notransaksi', 10)->nullable();
                $table->char('kodebrg', 10)->nullable();
                $table->integer('hargabeli');
                $table->integer('qty');
                $table->integer('diskon');
                $table->integer('diskonrp');
                $table->integer('totalrp');
                $table->timestamps();

                $table->foreign('notransaksi')->references('notransaksi')->on('hbelis')->cascadeOnDelete();
                $table->foreign('kodebrg')->references('kodebrg')->on('barangs')->cascadeOnDelete();
            } catch (\Throwable $th) {
                print_r($th);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dbelis');
    }
};
