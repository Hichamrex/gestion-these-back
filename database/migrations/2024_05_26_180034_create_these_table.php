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
        Schema::create('these', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('sujet');
            $table->string('duree');
            $table->string('resume');
            $table->string('mot_cles');
            $table->string('discipline');
            $table->boolean('preparation');
            $table->boolean('soutenue');
            $table->date('date_publication')->nullabe();
            $table->date('date_soutenance')->nullable();
            $table->unsignedBigInteger('agent_recherche_id')->nullable();
            $table->foreign('agent_recherche_id')->references('id')->on('user')->onDelete('set null');
            
            $table->unsignedBigInteger('laboratoire_id')->nullable();
            $table->foreign('laboratoire_id')->references('id')->on('laboratoire')->onDelete('set null');
            
            $table->unsignedBigInteger('directeur_these_id')->nullable();
            $table->foreign('directeur_these_id')->references('id')->on('user')->onDelete('set null');
            
            $table->unsignedBigInteger('doctorant_id')->nullable();
            $table->foreign('doctorant_id')->references('id')->on('user')->onDelete('set null');

            $table->unsignedBigInteger('examinateur_id')->nullable();
            $table->foreign('examinateur_id')->references('id')->on('user')->onDelete('set null');

            $table->unsignedBigInteger('rapporteur_id')->nullable();
            $table->foreign('rapporteur_id')->references('id')->on('user')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('these');
    }
};
