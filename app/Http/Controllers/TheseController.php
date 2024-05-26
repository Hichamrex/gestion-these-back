<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\These;


class TheseController extends Controller
{

    public function index()
    {
        return response()->json(These::all(), 200);
    }

    public function store(Request $request)
    {
            $table->unsignedBigInteger('agent_recherche_id')->nullable();
            $table->foreign('agent_recherche_id')->references('id')->on('agent_recherche')->onDelete('set null');
            
            $table->unsignedBigInteger('laboratoire_id')->nullable();
            $table->foreign('laboratoire_id')->references('id')->on('laboratoire')->onDelete('set null');
            
            $table->unsignedBigInteger('directeur_these_id')->nullable();
            $table->foreign('directeur_these_id')->references('id')->on('directeur_these')->onDelete('set null');
            
            $table->unsignedBigInteger('doctorant_id')->nullable();
            $table->foreign('doctorant_id')->references('id')->on('doctorant')->onDelete('set null');
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'sujet' => 'required|string|max:255',
            'date_demarrage' => 'required|date',
            'date_publication' => 'date',
            'date_soutenance' => 'date',
            'agent_recherche_id' => 'required|integer',
            'laboratoire_id' => 'required|integer',
            'directeur_these_id' => 'required|integer',
            'doctorant_id' => 'required|integer',
        ]);

        $superAdmin = These::create($validated);
        return response()->json($superAdmin, 201);
    }

    public function show(These $superAdmin)
    {
        return response()->json($superAdmin, 200);
    }

    public function update(Request $request, These $id)
    {
        $validated = $request->validate([
            'titre' => 'sometimes|string|max:255',
            'sujet' => 'sometimes|string|max:255',
            'date_demarrage' => 'sometimes|date',
            'date_publication' => 'sometimes|date',
            'date_soutenance' => 'sometimes|date',
            'agent_recherche_id' => 'required|integer',
            'laboratoire_id' => 'required|integer',
            'directeur_these_id' => 'required|integer',
            'doctorant_id' => 'required|integer',
        ]);

        $id->update($validated);
        return response()->json($id, 200);
    }

    public function destroy(These $id)
    {
        $id->delete();
        return response()->json(null, 204);
    }
    
}
