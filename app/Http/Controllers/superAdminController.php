<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\superAdmin;

class superAdminController extends Controller
{
    public function index()
    {
        return response()->json(superAdmin::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:super_admins',
            'role' => 'required|string|max:50',
            'password' => 'required|string|min:8',
        ]);

        $superAdmin = superAdmin::create($validated);
        return response()->json($superAdmin, 201);
    }

    public function show(superAdmin $superAdmin)
    {
        return response()->json($superAdmin, 200);
    }

    public function update(Request $request, superAdmin $superAdmin)
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:super_admins,email,' . $superAdmin->id,
            'password' => 'sometimes|string|min:8',
        ]);

        $superAdmin->update($validated);
        return response()->json($superAdmin, 200);
    }

    public function destroy(superAdmin $superAdmin)
    {
        $superAdmin->delete();
        return response()->json(null, 204);
    }
}
