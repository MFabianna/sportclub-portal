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
        Schema::create('participations', function (Blueprint $table) {
            $table->id();

            // Clé étrangère vers la table joueurs
            // onDelete('cascade') : Si le joueur est supprimé, sa participation disparaît aussi.
            $table->foreignId('joueur_id')->constrained('joueurs')->onDelete('cascade');

            // Clé étrangère vers la table evenements
            // onDelete('cascade') : Si l'événement est supprimé, toutes les participations liées disparaissent.
            $table->foreignId('evenement_id')->constrained('evenements')->onDelete('cascade');

            // Statut de présence physique le jour J (true/false)
            $table->boolean('present')->default(false);

            // Réponse à la convocation numérique
            $table->enum('reponse', ['en_attente', 'confirme', 'decline'])->default('en_attente');

            $table->timestamps();

            // CONTRAINTE UNIQUE : Empêche un joueur d'avoir plusieurs lignes pour le même événement.
            $table->unique(['joueur_id', 'evenement_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participations');
    }
};