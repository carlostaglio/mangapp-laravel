<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MangaController extends Controller
{
    public function index()
    {
        return Manga::with('subcategoria.categoria')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'portada' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'subcategoria_id' => 'required|exists:subcategorias,id',
        ]);

        if ($request->hasFile('portada')) {
            $validated['portada'] = $request->file('portada')->store('imagenes', 'public');
        }

        return Manga::create($validated);
    }

    public function show(Manga $manga)
    {
        return $manga->load('subcategoria.categoria');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'titulo' => 'string|max:255',
            'portada' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'subcategoria_id' => 'exists:subcategorias,id',
        ]);

        $manga = Manga::where("id",$id)->first();
        if ($request->hasFile('portada')) {
            if ($manga->portada) {
                Storage::disk('public')->delete($manga->portada);
            }
            $validated['portada'] = $request->file('portada')->store('imagenes', 'public');
        }

        $manga->update($validated);

        return $manga;
    }

    public function destroy($id)
    {
        $manga = Manga::where("id",$id)->first();
        if ($manga->portada) {
            Storage::disk('public')->delete($manga->portada);
        }
        $manga->delete();
        return response()->noContent();
    }

    public function imagen($id) 
    {
        $manga = Manga::where("id",$id)->first();
        //return Storage::disk('public')->get($manga->portada);
        return Storage::disk('public')->download($manga->portada);
    }
}
