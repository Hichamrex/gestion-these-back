<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laboratoire;

class LaboratoireController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'message' => "Departement Created successfully",
            'data' => Laboratoire::all()], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'departement_id' => 'required|integer',
            'super_admin_id' => 'required|integer',
        ]);

        $laboratoire = Laboratoire::create($validated);
        return response()->json([
            'status' => 200,
            'message' => "Lab Created successfully",
            'data' => []], 201);
    }

    public function show(Laboratoire $id)
    {
        return response()->json([
            'status' => 200,
            'message' => "Departement Created successfully",
            'data' => $id], 200);
    }

    public function update(Request $request, Laboratoire $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'departement_id' => 'required|integer',
            'super_admin_id' => 'required|integer',
        ]);

        $id->update($validated);
        return response()->json([
            'status' => 200,
            'message' => "Lab Updated successfully",
            'data' => []], 200);
    }

    public function destroy(Laboratoire $id)
    {
        $id->delete();
        return response()->json([
            'status' => 200,
            'message' => "Departement Deleted successfully",
            'data' => []], 204);
    }
}
