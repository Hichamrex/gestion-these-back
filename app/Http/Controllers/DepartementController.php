<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\departement;

class DepartementController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'message' => "Departement Created successfully",
            'data' => departement::all()], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'super_admin_id' => 'required|integer',
        ]);

        $departement = departement::create($validated);
        return response()->json([
            'status' => 200,
            'message' => "Departement Created successfully"], 200);
    }

    public function show(departement $id)
    {
        return response()->json([
            'status' => 200,
            'message' => "Departement Created successfully", 
            'data' => $id], 200);
    }

    public function update(Request $request, departement $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'super_admin_id' => 'required|integer',
        ]);

        $id->update($validated);
        return response()->json([
            'status' => 200,
            'message' => "Departement Updated successfully"], 200);
    }

    public function destroy(departement $id)
    {
        $id->delete();
        return response()->json([
            'status' => 200,
            'message' => "Departement Deleted successfully"], 200);
    }
}
