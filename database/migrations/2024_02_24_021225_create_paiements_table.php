<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('personnel_id');
            $table->foreign('personnel_id')->references('id')->on('personnels')->onDelete('cascade');
            $table->unsignedBigInteger('pointage_id')->nullable();
            $table->foreign('pointage_id')->references('id')->on('pointages')->onDelete('cascade');
            $table->date('date_paiement');
            $table->decimal('montant');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
