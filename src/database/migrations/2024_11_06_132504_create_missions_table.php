<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {

            $table->id();
//            $table->string('mle_agent');  Nom de la personne titulaire du permis
            $table->string('permit_holder'); // Nom de la personne titulaire du permis
            $table->string('cin'); // Numéro de carte
            $table->string('license_number'); // Numéro de licence
            $table->string('rank_or_position'); // Rang ou position
            $table->string('internal_function'); // Fonction interne
            $table->string('vehicle_usage_reason'); // Raison de l'utilisation du véhicule
            $table->date('start_date'); // Date de début de la mission
            $table->time('start_time'); // Heure de début de la mission
            $table->date('return_date'); // Date de retour de la mission
            $table->time('return_time'); // Heure de retour de la mission
            $table->string('departure_location'); // Lieu de départ
            $table->string('destination_location'); // Destination
            $table->json('companions'); // Liste des compagnons
            $table->string('expenses', 100); // Dépenses
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Clé étrangère vers `users`
            $table->timestamps(); // created_at et updated_at


            $table->index('cin');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
};
