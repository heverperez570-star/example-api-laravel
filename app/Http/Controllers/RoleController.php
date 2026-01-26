<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::get();

            if (count($roles) < 1) {
                return response()->json([
                    'message' => 'No hay roles disponibles.',
                    'data' => [],
                    'status' => 'success',
                ], 200);
            }

            return response()->json([
                'message' => 'Roles obtenidos correctamente.',
                'data' => $roles,
                'status' => 'success',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
                'message' => 'Error al obtener los roles.',
                'data' => [],
                'status' => 'error',
            ], 500);
        }
    }

    public function show($id)
    {
        
    }

    public function store(Request $request)
    {
        try {
            $newRole = new Role();

            $newRole->slug = $request->slug;
            $newRole->name = $request->name;
            $newRole->description = $request->description;
            $newRole->status = $request->status == null ? true : $request->status;

            $newRole->save();

            return response()->json([
                'message' => 'Rol creado correctamente.',
                'data' => $newRole,
                'status' => 'success',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage(),
                'message' => 'Error al crear el rol.',
                'data' => null,
                'status' => 'error',
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
