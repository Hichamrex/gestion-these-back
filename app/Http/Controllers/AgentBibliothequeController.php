<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgentBibliotheque;


class AgentBibliothequeController extends Controller
{
    public function index()
    {
        return response()->json(AgentBibliotheque::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:equipe_recherche,email,' . $request->id,
            'password' => 'required|string|min:8',
            'super_admin_id' => 'required|integer',
        ]);

        $equipeRecherche = AgentBibliotheque::create($validated);
        return response()->json($equipeRecherche, 201);
    }

    public function show(AgentBibliotheque $id)
    {
        return response()->json($id, 200);
    }

    public function update(Request $request, AgentBibliotheque $id)
    {
        $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:equipe_recherche,email,' . $id->id,
                'password' => 'required|string|min:8',
                'super_admin_id' => 'required|integer',
        ]);

        $id->update($validated);
        return response()->json($id, 200);
    }

    public function destroy(AgentBibliotheque $id)
    {
        $id->delete();
        return response()->json(null, 204);
    }
}
