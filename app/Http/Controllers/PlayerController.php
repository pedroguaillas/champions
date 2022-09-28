<?php

namespace App\Http\Controllers;

class PlayerController extends Controller
{
    public function index(int $team_id)
    {
        return view('players', compact('team_id'));
    }
}
