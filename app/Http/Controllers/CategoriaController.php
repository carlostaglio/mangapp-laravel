<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class CategoriaController extends Controller
{
    public function index()
    {
        return Categoria::with('subcategorias')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);
        return Categoria::create($validated);;
    }

    public function show(Categoria $categoria) 
    { 
        return $categoria->load('subcategorias'); 
    } 

    public function update(Request $request, $id) 
    { 
        $validated = $request->validate([ 
            'nombre' => 'required|string|max:255', 
        ]); 
        $categoria = Categoria::where("id",$id)->first();
        $categoria->update($validated); 
        return $categoria; 
    } 

    public function destroy($id) 
    { 
        $categoria = Categoria::where("id",$id)->first();
        $categoria->delete(); 
        return response()->noContent(); 
    }
    
}
