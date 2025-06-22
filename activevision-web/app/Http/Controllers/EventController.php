<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentifiedLog;
use App\Models\Event;
use App\Models\UserLog;
use App\Models\ComputerLog;
use App\Models\GroupLog;

class EventController extends Controller
{
    /**
     * Affiche la liste des événements des utilisateurs.
     */
    public function indexUsers()
    {
        $userLogs = UserLog::with('identifiedLog.event')->get(); // Charge les logs utilisateur avec les relations associées
        return view('events-users', compact('userLogs')); // Passe les logs utilisateur à la vue
    }

    /**
     * Affiche les détails d'un événement utilisateur.
     */
    public function showUserEvent($userLogId)
    {
        $log = UserLog::with('identifiedLog.event')->findOrFail($userLogId); // Charge un log utilisateur spécifique avec ses relations
        return view('events-details', compact('log')); // Passe le log utilisateur à la vue
    }

    /**
     * Affiche la liste des événements des ordinateurs.
     */
    public function indexComputers()
    {
        $computerLogs = ComputerLog::with('identifiedLog.event')->get(); // Charge les logs ordinateur avec les relations associées
        return view('events-computers', compact('computerLogs')); // Passe les logs ordinateur à la vue
    }

    /**
     * Affiche les détails d'un événement ordinateur.
     */
    public function showComputerEvent($computerLogId)
    {
        $log = ComputerLog::with('identifiedLog.event')->findOrFail($computerLogId); // Charge un log ordinateur spécifique avec ses relations
        return view('events-details', compact('log')); // Passe le log ordinateur à la vue
    }

    /**
     * Affiche la liste des événements des groupes.
     */
    public function indexGroups()
    {
        $groupLogs = GroupLog::with('identifiedLog.event')->get(); // Charge les logs groupe avec les relations associées
        return view('events-groups', compact('groupLogs')); // Passe les logs groupe à la vue
    }

    /**
     * Affiche les détails d'un événement groupe.
     */
    public function showGroupEvent($groupLogId)
    {
        $log = GroupLog::with('identifiedLog.event')->findOrFail($groupLogId); // Charge un log groupe spécifique avec ses relations
        return view('events-details', compact('log')); // Passe le log groupe à la vue
    }
}