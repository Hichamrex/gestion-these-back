<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\These;


class TheseController extends Controller
{

    public function index()
    {
        $theses = These::with('juries')->get();

        $theses->each(function($these) {
            $these->jury_ids = $these->juries->pluck('id');
            unset($these->juries); // Remove the full juries data
        });

        return response()->json([
            'status' => 200,
            'message' => "Departement Created successfully",
            'data' => $theses], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'sujet' => 'required|string|max:255',
            'duree' => 'required|string',
            'resume' => 'required|string|max:4000',
            'mot_cles' => 'required|string',
            'date_publication' => 'required|date',
            'date_soutenance' => 'required|date',
            'agent_recherche_id' => 'required|integer',
            'laboratoire_id' => 'required|integer',
            'directeur_these_id' => 'required|integer',
            'doctorant_id' => 'required|integer',
            'examinateur_id' => 'required|integer',
            'rapporteur_id' => 'required|integer',
            'juries' => 'required|array',
            'juries.*' => 'integer|exists:user,id',
        ]);

        $these = These::create($validated);
        $these->juries()->sync($request->juries);


        return response()->json([
            'status' => 200,
            'message' => "Departement Created successfully",
            'data' => []], 200);
    }

    public function show(These $id)
    {

        // $these = These::find($id);
                // Eager load the 'juries' relationship
                $id->load('juries:id');

                // Format the response data as needed
                $formattedid = [
                    'id' => $id->id,
                    'titre' => $id->titre,
                    'sujet' => $id->sujet,
                    'duree' => $id->duree,
                    'resume' => $id->resume,
                    'mot_cles' => $id->mot_cles,
                    'date_publication' => $id->date_publication,
                    'date_soutenance' => $id->date_soutenance,
                    'agent_recherche_id' => $id->agent_recherche_id,
                    'laboratoire_id' => $id->laboratoire_id,
                    'directeur_these_id' => $id->directeur_these_id,
                    'doctorant_id' => $id->doctorant_id,
                    'examinateur_id' => $id->examinateur_id,
                    'rapporteur_id' => $id->rapporteur_id,
                    'juries' => $id->juries->pluck('id')->toArray()
                ];
        
                return response()->json([
                    'status' => 200,
                    'message' => "these retrieved successfully",
                    'data' => $formattedid,
                ], 200);
            }

    // $these = These::with('juries:id')->find(2);

    //     $these->each(function($these) {
    //         $these->jury_ids = $these->juries->pluck('id');
    //         unset($these->juries); // Remove the full juries data
    //     });

    // return response()->json([
    //     'status' => 200,
    //     'message' => "These retrieved successfully",
    //     'data' => $these
    // ], 200);
    // }

    public function update(Request $request, These $id)
    {
        $validated = $request->validate([
            'titre' => 'sometimes|string|max:255',
            'sujet' => 'sometimes|string|max:255',
            'duree' => 'sometimes|string',
            'resume' => 'required|string|max:4000',
            'mot_cles' => 'required|string',
            'date_publication' => 'sometimes|date',
            'date_soutenance' => 'sometimes|date',
            'agent_recherche_id' => 'required|integer',
            'laboratoire_id' => 'required|integer',
            'directeur_these_id' => 'required|integer',
            'doctorant_id' => 'required|integer',
            'examinateur_id' => 'required|integer',
            'rapporteur_id' => 'required|integer',
            'juries' => 'required|array',
            'juries.*' => 'integer|exists:user,id',
        ]);

    // $these = These::findOrFail($id);
    $id->update($validated);

    // Sync the many-to-many relationship
    if ($request->has('juries')) {
        $id->juries()->sync($request->juries);
    }

    $id->load('juries:id');
    $id->jury_ids = $id->juries->pluck('id');
    unset($id->juries); // Remove the full juries data
    
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
