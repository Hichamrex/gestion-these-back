<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgentRecherche;


class AgentRechercheController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'message' => "Agent Recherche Created successfully",
            'data' => AgentRecherche::all()]
            , 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:equipe_recherche,email,' . $request->id,
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'super_admin_id' => 'required|integer',
        ]);

        $equipeRecherche = AgentRecherche::create($validated);
        return response()->json([
            'status' => 200,
            'message' => "Agent Recherche Created successfully",
            'data' => $equipeRecherche], 201);
    }

    public function show(AgentRecherche $id)
    {
        return response()->json([
            'status' => 200,
            'message' => "Agent Recherche Created successfully",
            'data' => $id], 200);
    }

    public function update(Request $request, AgentRecherche $id)
    {
        $validated = $request->validate([
                'first_name' => 'sometimes|string|max:255',
                'last_name' => 'sometimes|string|max:255',
                'email' => 'sometimes|string|email|max:255|unique:equipe_recherche,email,' . $id->id,
                'password' => 'sometimes|string|min:8',
                'role' => 'sometimes|string',
                'super_admin_id' => 'sometimes|integer',
        ]);

        $id->update($validated);
        return response()->json([
            'status' => 200,
            'message' => "Agent Recherche Created successfully",
            'data' => $id], 200);
    }

    public function destroy(AgentRecherche $id)
    {
        $id->delete();
        return response()->json([
            'status' => 200,
            'message' => "Agent Recherche Deleted successfully",
            'data' => []]);
    }
}
