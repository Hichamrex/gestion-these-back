<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departement', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('super_admin_id')->nullable();
            $table->foreign('super_admin_id')->references('id')->on('super_admins')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departement');
    }
};
