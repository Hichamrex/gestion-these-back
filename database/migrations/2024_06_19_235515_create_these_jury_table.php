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
        Schema::create('these_jury', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('these_id');
            $table->unsignedBigInteger('jury_id');
            $table->timestamps();

            $table->foreign('these_id')->references('id')->on('these')->onDelete('cascade');
            $table->foreign('jury_id')->references('id')->on('user')->onDelete('cascade');
            
            $table->unique(['these_id', 'jury_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('these_jury');
    }
};
