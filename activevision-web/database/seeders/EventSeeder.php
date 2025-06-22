<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('event')->insert([
            [
                'idEvent' => 1,
                'titre' => 'Mot de passe modifié',
                'description' => 'L’utilisateur a changé son mot de passe.',
                'created_at' => '2025-06-05 11:19:59',
                'updated_at' => '2025-06-05 11:19:59',
            ],
            [
                'idEvent' => 2,
                'titre' => 'Compte verrouillé',
                'description' => 'Trop de tentatives échouées.',
                'created_at' => '2025-06-05 11:19:59',
                'updated_at' => '2025-06-05 11:19:59',
            ],
            [
                'idEvent' => 3,
                'titre' => 'Groupe modifié',
                'description' => 'Un groupe a été modifié.',
                'created_at' => '2025-06-05 11:19:59',
                'updated_at' => '2025-06-05 11:19:59',
            ],
            [
                'idEvent' => 4,
                'titre' => 'PC ajouté',
                'description' => 'Nouvel ordinateur détecté.',
                'created_at' => '2025-06-05 11:19:59',
                'updated_at' => '2025-06-05 11:19:59',
            ],
            [
                'idEvent' => 5,
                'titre' => 'Membre ajouté au groupe',
                'description' => 'Un utilisateur a été ajouté à un groupe.',
                'created_at' => '2025-06-05 11:19:59',
                'updated_at' => '2025-06-05 11:19:59',
            ],
            [
                'idEvent' => 6,
                'titre' => 'Compte activé',
                'description' => 'Un compte utilisateur a été activé.',
                'created_at' => '2025-06-10 11:56:17',
                'updated_at' => '2025-06-10 11:56:17',
            ],
            [
                'idEvent' => 7,
                'titre' => 'Compte créé',
                'description' => 'Un nouveau compte utilisateur a été créé.',
                'created_at' => '2025-06-10 11:56:17',
                'updated_at' => '2025-06-10 11:56:17',
            ],
            [
                'idEvent' => 8,
                'titre' => 'Membre retiré du groupe',
                'description' => 'Un utilisateur a été retiré d\'un groupe.',
                'created_at' => '2025-06-10 11:56:17',
                'updated_at' => '2025-06-10 11:56:17',
            ],
            [
                'idEvent' => 9,
                'titre' => 'Attributs de compte modifiés',
                'description' => 'Les attributs d\'un compte utilisateur ont été modifiés.',
                'created_at' => '2025-06-10 11:56:17',
                'updated_at' => '2025-06-10 11:56:17',
            ],
            [
                'idEvent' => 10,
                'titre' => 'Connexion anonyme détectée',
                'description' => 'Une connexion anonyme a été détectée sur la machine.',
                'created_at' => '2025-06-10 11:56:17',
                'updated_at' => '2025-06-10 11:56:17',
            ],
            [
                'idEvent' => 11,
                'titre' => 'Changement d\'appartenance à un groupe',
                'description' => 'Un utilisateur a changé d\'appartenance à un groupe.',
                'created_at' => '2025-06-10 11:56:17',
                'updated_at' => '2025-06-10 11:56:17',
            ],
            [
                'idEvent' => 12,
                'titre' => 'Membre ajouté à un groupe local',
                'description' => 'Un compte a été ajouté à un group local',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
            [
                'idEvent' => 13,
                'titre' => 'Membre retiré d’un groupe local',
                'description' => 'Un compte a été retiré d\'un group local',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
            [
                'idEvent' => 14,
                'titre' => 'Propriétés du compte utilisateur modifiées',
                'description' => 'Les propriétés d’un compte utilisateur ont été modifiées sur cet ordinateur.',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
            [
                'idEvent' => 15,
                'titre' => 'Membre ajouté à un groupe local',
                'description' => 'Un utilisateur a été ajouté à un groupe local sur cet ordinateur.',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
            [
                'idEvent' => 16,
                'titre' => 'Membre retiré d’un groupe local',
                'description' => 'Un utilisateur a été retiré d’un groupe local sur cet ordinateur.',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
            [
                'idEvent' => 17,
                'titre' => 'Groupe local modifié',
                'description' => 'Un groupe local a été modifié sur cet ordinateur.',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
            [
                'idEvent' => 18,
                'titre' => 'Connexion anonyme détectée',
                'description' => 'Une connexion anonyme a été détectée sur cet ordinateur.',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
        ]);
    }
}