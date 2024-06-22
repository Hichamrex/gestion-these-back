<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\These;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



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
            'discipline'=> 'required|string',
         'preparation' => 'required|boolean',
         'soutenue' => 'required|boolean',
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
                    'discipline'=> $id->discipline,
                    'preparation' => $id->preparation,
                    'soutenue' => $id->soutenue,
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
            'discipline'=> 'required|string',
            'preparation' => 'required|boolean',
            'soutenue' => 'required|boolean',
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
   
//     public function getThesesByUser($userId)
//     {
//         // Get all theses where the user is involved in any role
//         $theses = These::where('these.agent_recherche_id', $userId)
//             ->orWhere('these.directeur_these_id', $userId)
//             ->orWhere('these.doctorant_id', $userId)
//             ->orWhere('these.examinateur_id', $userId)
//             ->orWhere('these.rapporteur_id', $userId)
//             ->orWhereHas('juries', function($query) use ($userId) {
//                 $query->where('user.id', $userId); // Specify table alias for 'id'
//             })
//             // ->with([
//             //     'juries:id,first_name,last_name', 
//             //     // 'agentRecherche:id,first_name,last_name', 
//             //     // 'directeurThese:id,first_name,last_name', 
//             //     // 'doctorant:id,first_name,last_name', 
//             //     // 'examinateur:id,first_name,last_name', 
//             //     // 'rapporteur:id,first_name,last_name'
//             // ])
//                     ->with('juries:id')
//             ->get();
    
//         // Prepare the response data
//         $formattedTheses = $theses->map(function($these) use ($userId) {
//             $roles = [];
            
//             if ($these->agent_recherche_id == $userId) {
//                 $roles[] = 'agent_recherche';
//             }
//             if ($these->directeur_these_id == $userId) {
//                 $roles[] = 'directeur_these';
//             }
//             if ($these->doctorant_id == $userId) {
//                 $roles[] = 'doctorant';
//             }
//             if ($these->examinateur_id == $userId) {
//                 $roles[] = 'examinateur';
//             }
//             if ($these->rapporteur_id == $userId) {
//                 $roles[] = 'rapporteur';
//             }
//             if ($these->juries->contains('id', $userId)) {
//                 $roles[] = 'jury';
//             }
    
//             return [
//                 'id' => $these->id,
//                 'titre' => $these->titre,
//                 'sujet' => $these->sujet,
//                 'duree' => $these->duree,
//                 'resume' => $these->resume,
//                 'mot_cles' => $these->mot_cles,
//                 'date_publication' => $these->date_publication,
//                 'date_soutenance' => $these->date_soutenance,
//                 'roles' => $roles,
//                 // 'agent_recherche' => $these->agentRecherche ? ['id' => $these->agentRecherche->id, 'first_name' => $these->agentRecherche->first_name, 'last_name' => $these->agentRecherche->last_name] : null,
//                 'directeur_these' => $these->directeurThese ? ['id' => $these->directeurThese->id, 'first_name' => $these->directeurThese->first_name, 'last_name' => $these->directeurThese->last_name] : null,
//                 'doctorant' => $these->doctorant ? ['id' => $these->doctorant->id, 'first_name' => $these->doctorant->first_name, 'last_name' => $these->doctorant->last_name] : null,
//                 'examinateur' => $these->examinateur ? ['id' => $these->examinateur->id, 'first_name' => $these->examinateur->first_name, 'last_name' => $these->examinateur->last_name] : null,
//                 'rapporteur' => $these->rapporteur ? ['id' => $these->rapporteur->id, 'first_name' => $these->rapporteur->first_name, 'last_name' => $these->rapporteur->last_name] : null,
//                 'juries' => $these->juries->map(function($jury) {
//                     return ['id' => $jury->id, 'first_name' => $jury->first_name, 'last_name' => $jury->last_name];
//                 })->toArray()
//             ];
//         });
    
//         return response()->json([
//             'status' => 200,
//             'message' => "Theses retrieved successfully",
//             'data' => $formattedTheses
//         ], 200);
//     }
// }    
public function getThesesByUser($userId)
{
    // Get all theses where the user is involved in any role
    $theses = These::where('agent_recherche_id', $userId)
        ->orWhere('directeur_these_id', $userId)
        ->orWhere('doctorant_id', $userId)
        ->orWhere('examinateur_id', $userId)
        ->orWhere('rapporteur_id', $userId)
        ->orWhereHas('juries', function($query) use ($userId) {
            $query->where('jury_id', $userId);
        })
        // ->with(['juries:id,first_name,last_name', 'directeurThese:id,first_name,last_name', 'doctorant:id,first_name,last_name', 'examinateur:id,first_name,last_name', 'rapporteur:id,first_name,last_name'])
        ->with('juries:id')
        // ->with(['juries:id,first_name,last_name'])
        // // ->with('agentRecherche:id,first_name,last_name')
        // ->with('directeurThese:id,first_name,last_name')
        // ->with('doctorant:id,first_name,last_name')
        // ->with('examinateur:id,first_name,last_name')
        // ->with('rapporteur:id,first_name,last_name')
        ->get();

    // Prepare the response data
    $formattedTheses = $theses->map(function($these) use ($userId) {
        $roles = [];
        
        if ($these->agent_recherche_id == $userId) {
            $roles[] = 'agent_recherche';
        }
        if ($these->directeur_these_id == $userId) {
            $roles[] = 'directeur_these';
        }
        if ($these->doctorant_id == $userId) {
            $roles[] = 'doctorant';
        }
        if ($these->examinateur_id == $userId) {
            $roles[] = 'examinateur';
        }
        if ($these->rapporteur_id == $userId) {
            $roles[] = 'rapporteur';
        }
        if ($these->juries->contains('id', $userId)) {
            $roles[] = 'jury';
        }

            return [
            'id' => $these->id,
            'titre' => $these->titre,
            'sujet' => $these->sujet,
            'duree' => $these->duree,
            'resume' => $these->resume,
            'mot_cles' => $these->mot_cles,
            'date_publication' => $these->date_publication,
            'date_soutenance' => $these->date_soutenance,
            'directeur_these_id' => $these->directeur_these_id,
            'doctorant_id' => $these->doctorant_id,
            // 'directeur_these' => $these->directeurThese ? ['id' => $these->directeurThese->id, 'first_name' => $these->directeurThese->first_name, 'last_name' => $these->directeurThese->last_name] : null,
            'roles' => $roles,
            ];
        });

        return response()->json([
            'status' => 200,
            'message' => "Theses retrieved successfully",
            'data' => $formattedTheses
        ], 200);
    }


    public function getThesisCounts()
    {
        // Count of theses that are in preparation
        $preparationCount = DB::table('these')->where('preparation', 1)->count();

        // Count of theses that are soutenue
        $soutenueCount = DB::table('these')->where('soutenue', 1)->count();

        // Number of unique users attached to the theses
        $uniqueUsersCount = DB::table(function ($query) {
            $query->select('agent_recherche_id AS user_id')->from('these')->whereNotNull('agent_recherche_id')
                ->union(
                    DB::table('these')->select('directeur_these_id')->whereNotNull('directeur_these_id')
                )
                ->union(
                    DB::table('these')->select('doctorant_id')->whereNotNull('doctorant_id')
                )
                ->union(
                    DB::table('these')->select('examinateur_id')->whereNotNull('examinateur_id')
                )
                ->union(
                    DB::table('these')->select('rapporteur_id')->whereNotNull('rapporteur_id')
                );
        })->distinct()->count('user_id');

        // Return the results as JSON
        return response()->json([
            'status' => 200,
            'message' => "Theses retrieved successfully",
            'data' => [
            'preparation_count' => $preparationCount,
            'soutenue_count' => $soutenueCount,
            'unique_users_count' => $uniqueUsersCount,
        ]]);
    }

    public function getUpcomingTheses()
    {
        $currentDate = Carbon::now();

        $theses = These::where('date_soutenance', '>', $currentDate)
                        ->where('preparation', 1)
                        ->orderBy('date_soutenance', 'asc')
                        ->get();

        return response()->json([
            'status' => 200,
            'message' => "Theses retrieved successfully",
            'data' => $theses
        ]);
    }

}
