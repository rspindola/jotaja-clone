<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    // Retorna todos os Departmentos
    public function index()
    {
        $departments = Department::all();
        return response()->json($departments);
    }

    // Cria um novo Departmento
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $department = Department::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json($department, 201);
    }

    // Retorna um Departmento específico
    public function show($id)
    {
        $department = Department::findOrFail($id);
        return response()->json($department);
    }

    // Atualiza um Departmento existente
    public function update(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $department->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json($department, 200);
    }

    // Exclui um Departmento
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return response()->json(null, 204);
    }
}
