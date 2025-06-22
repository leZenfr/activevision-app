<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Récupère tous les utilisateurs
        return view('users', compact('users'));
    }
}