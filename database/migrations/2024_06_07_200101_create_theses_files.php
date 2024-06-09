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
        Schema::create('theses_files', function (Blueprint $table) {
            $table->id();
            // file metadata
            $table->string('name')->nullable();
            $table->string('original_name')->nullable();

            // Foreign keys
            $table->unsignedBigInteger('these_id')->nullable();
            $table->foreign('these_id')->references('id')->on('these')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theses_files');
    }
};
