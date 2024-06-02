<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserThese;

class UserTheseController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'message' => "User Created successfully",
            'data' => UserThese::all()], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email,' . $request->id,
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'laboratoire_id' => 'nullable|exists:laboratoire,id',
            'super_admin_id' => 'required|integer',
        ]);

        $userThese = UserThese::create($validated);
        return response()->json([
            'status' => 200,
            'message' => "Lab Created successfully",
            'data' => []], 201);
    }

    public function show(UserThese $id)
    {
        return response()->json([
            'status' => 200,
            'message' => "Departement Created successfully",
            'data' => $id], 200);
    }

    public function update(Request $request, UserThese $id)
    {
        $validated = $request->validate([
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:super_admins,email,' . $id->id,
            'password' => 'sometimes|string|min:8',
        ]);

        $id->update($validated);
        return response()->json([
            'status' => 200,
            'message' => "Lab Updated successfully",
            'data' => []], 200);
    }

    public function destroy(UserThese $id)
    {
        $id->delete();
        return response()->json([
            'status' => 200,
            'message' => "Departement Deleted successfully",
            'data' => []]);
    }
}
