<?php

namespace App\Http\Controllers;

use App\Models\Subcategoria;
use Illuminate\Http\Request;

class SubcategoriaController extends Controller
{
    public function index()
    {
        return Subcategoria::with('category')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
        ]);
        if ($validated) {
            return Subcategoria::create($validated);
        } else {
            return "Error";
        }
    }

    public function show(Subcategoria $subcategoria)
    {
        return $subcategoria->load('categoria');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
        
        $subcategoria = Subcategoria::where("id",$id)->first();
        $subcategoria->update($validated);

        return $subcategoria;
    }

    public function destroy($id)
    {
        $subcategoria = Subcategoria::where("id",$id)->first();
        $subcategoria->delete();

        return response()->noContent();
    }
}
