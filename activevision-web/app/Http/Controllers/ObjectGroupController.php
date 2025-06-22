<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ObjectGroup;

use App\Models\GroupLog;

class ObjectGroupController extends Controller
{
    /**
     * Affiche la liste des groupes.
     */
    public function index()
    {
        $objectGroups = ObjectGroup::all(); // Récupère tous les groupes
        return view('objectgroup', compact('objectGroups')); // Passe les données à la vue
    }

    public function search(Request $request)
    {
        $query = ObjectGroup::query();

        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';

            // Recherche sur plusieurs colonnes
            $query->where(function ($q) use ($searchTerm) {
                $q->where('objectSid', 'LIKE', $searchTerm)
                ->orWhere('distinguishedName', 'LIKE', $searchTerm);
            });
        }

        $objectGroups = $query->get();
        return view('objectgroup', compact('objectGroups'));
    }

    /**
     * Affiche les détails d'un groupe.
     */
    public function show($objectSid, Request $request)
    {
        $objectGroup = ObjectGroup::where('objectSid', $objectSid)->firstOrFail();
    
        // Nombre de logs par page (valeur par défaut : 15)
        $perPage = $request->input('per_page', 15);
    
        // Filtrer les logs liés au groupe en fonction du SID dans plusieurs champs
        $groupLogs = GroupLog::with('identifiedLog.event')
            ->where(function ($query) use ($objectSid) {
                $query->where('subjectUserSid', $objectSid) // Filtrage basé sur subjectUserSid
                      ->orWhere('targetSid', $objectSid)   // Filtrage basé sur targetSid
                      ->orWhere('memberSid', $objectSid); // Filtrage basé sur memberSid
            })
            ->paginate($perPage); // Pagination dynamique
    
        return view('objectgroup-detail', compact('objectGroup', 'groupLogs', 'perPage'));
    }
}