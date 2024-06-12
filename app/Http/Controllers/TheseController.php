<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\These;


class TheseController extends Controller
{

    public function index()
    {
        return response()->json([
            'status' => 200,
            'message' => "Departement Created successfully",
            'data' => These::all()], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'sujet' => 'required|string|max:255',
            'duree' => 'required|string',
            'date_publication' => 'required|date',
            'date_soutenance' => 'required|date',
            'agent_recherche_id' => 'required|integer',
            'laboratoire_id' => 'required|integer',
            'directeur_these_id' => 'required|integer',
            'doctorant_id' => 'required|integer',
        ]);

        $superAdmin = These::create($validated);
        return response()->json([
            'status' => 200,
            'message' => "Departement Created successfully",
            'data' => []], 200);
    }

    public function show(These $id)
    {
        return response()->json([
            'status' => 200,
            'message' => "Departement Created successfully",
            'data' => $id], 200);
    }

    public function update(Request $request, These $id)
    {
        $validated = $request->validate([
            'titre' => 'sometimes|string|max:255',
            'sujet' => 'sometimes|string|max:255',
            'duree' => 'sometimes|string',
            'date_publication' => 'sometimes|date',
            'date_soutenance' => 'sometimes|date',
            'agent_recherche_id' => 'required|integer',
            'laboratoire_id' => 'required|integer',
            'directeur_these_id' => 'required|integer',
            'doctorant_id' => 'required|integer',
        ]);

        $id->update($validated);
        return response()->json([
            'status' => 200,
            'message' => "Departement Created successfully",
            'data' => $id], 200);
    }

    public function destroy(These $id)
    {
        $id->delete();
        return response()->json([
            'status' => 200,
            'message' => "Departement Created successfully",
            'data' => []], 200);
    }
    
}
