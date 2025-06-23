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
                'idEvent' => 4720,
                'titre' => 'Compte utilisateur créé',
                'description' => 'Un compte utilisateur a été créé.',
                'created_at' => '2025-06-05 11:19:59',
                'updated_at' => '2025-06-05 11:19:59',
            ],
            [
                'idEvent' => 4722,
                'titre' => 'Compte utilisateur activé',
                'description' => 'Un compte utilisateur a été activé.',
                'created_at' => '2025-06-05 11:19:59',
                'updated_at' => '2025-06-05 11:19:59',
            ],
            [
                'idEvent' => 4725,
                'titre' => 'Compte utilisateur désactivé',
                'description' => 'Un compte utilisateur a été désactivé.',
                'created_at' => '2025-06-05 11:19:59',
                'updated_at' => '2025-06-05 11:19:59',
            ],
            [
                'idEvent' => 4726,
                'titre' => 'Compte utilisateur supprimé',
                'description' => 'Un compte utilisateur a été supprimé.',
                'created_at' => '2025-06-05 11:19:59',
                'updated_at' => '2025-06-05 11:19:59',
            ],
            [
                'idEvent' => 4738,
                'titre' => 'Compte utilisateur modifié',
                'description' => 'Un compte utilisateur a été modifié',
                'created_at' => '2025-06-05 11:19:59',
                'updated_at' => '2025-06-05 11:19:59',
            ],
            [
                'idEvent' => 4740,
                'titre' => 'Compte verrouillé',
                'description' => 'Un compte utilisateur a été verrouillé.',
                'created_at' => '2025-06-10 11:56:17',
                'updated_at' => '2025-06-10 11:56:17',
            ],
            [
                'idEvent' => 4781,
                'titre' => 'Nom de compte modifié',
                'description' => 'Le nom du compte utilisateur a été modifié',
                'created_at' => '2025-06-10 11:56:17',
                'updated_at' => '2025-06-10 11:56:17',
            ],
            [
                'idEvent' => 4731,
                'titre' => 'Groupe local créé',
                'description' => 'Un groupe local avec sécurité activée a été créé.',
                'created_at' => '2025-06-10 11:56:17',
                'updated_at' => '2025-06-10 11:56:17',
            ],
            [
                'idEvent' => 4732,
                'titre' => 'Membre ajouté à un groupe local',
                'description' => 'Un membre a été ajouté à un groupe local avec sécurité activée.',
                'created_at' => '2025-06-10 11:56:17',
                'updated_at' => '2025-06-10 11:56:17',
            ],
            [
                'idEvent' => 4733,
                'titre' => 'Membre retiré d\'un groupe local',
                'description' => 'Un membre a été supprimé d’un groupe local avec sécurité activée.',
                'created_at' => '2025-06-10 11:56:17',
                'updated_at' => '2025-06-10 11:56:17',
            ],
            [
                'idEvent' => 4734,
                'titre' => 'Groupe locale supprimé',
                'description' => 'Un groupe local avec sécurité activée a été supprimé.',
                'created_at' => '2025-06-10 11:56:17',
                'updated_at' => '2025-06-10 11:56:17',
            ],
            [
                'idEvent' => 4735,
                'titre' => 'Groupe local modifié',
                'description' => 'Un groupe local avec sécurité activée a été modifié.',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
            [
                'idEvent' => 4727,
                'titre' => 'Groupe global créé (voir 4731)',
                'description' => 'Un groupe global avec sécurité activée a été créé. Voir l\'événement 4731.',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
            [
                'idEvent' => 4737,
                'titre' => 'Groupe global modifié (4735)',
                'description' => 'Un groupe global avec sécurité activée a été modifié. Voir l\'événement 4735.',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
            [
                'idEvent' => 4728,
                'titre' => 'Membre ajouté à un groupe global (4732)',
                'description' => ' Un membre a été ajouté à un groupe global avec sécurité activée. Voir l\'événement 4732.',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
            [
                'idEvent' => 4729,
                'titre' => 'Membre retiré d’un groupe global (4733)',
                'description' => 'Un membre a été supprimé d’un groupe global avec sécurité activée. Voir l\'événement 4733.',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
            [
                'idEvent' => 4730,
                'titre' => 'Groupe global supprimé (4734)',
                'description' => 'Un groupe global avec sécurité activée a été supprimé. Voir l \'événement 4734.',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
            [
                'idEvent' => 4754,
                'titre' => 'Groupe universel créé (4731)',
                'description' => 'Un groupe universel avec sécurité activée a été créé. Voir l\'événement 4731.',
                'created_at' => '2025-06-10 12:02:04',
                'updated_at' => '2025-06-10 12:02:04',
            ],
        ]);
    }
}
