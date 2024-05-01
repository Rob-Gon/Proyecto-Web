<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\Category;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DB::select('SELECT * FROM categories WHERE user_id = ?', [session('user_id')]);

        return view('category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $words = DB::select('SELECT * FROM words');
        $categories = DB::select('SELECT * FROM categories');
        $translations = DB::select('SELECT * FROM translations');

        return view('category.create', ['words' => $words, 'categories' => $categories, 'translations' => $translations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|min:3|max:255',
            'color' => 'required|max:7',
        ]);

        DB::insert('INSERT INTO categories (category, color, language_id, user_id) VALUES (?, ?, ?, ?)', [$request->category, $request->color, $request->language_id, session('user_id')]);

        return redirect()->route('category.create')->with('store_success', '¡Categoría agregada!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category = DB::selectOne('SELECT * FROM categories WHERE id = ?', [$category->id]);

        return view('category.show', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'category' => 'required|min:3|max:255',
            'color' => 'required|max:7',
        ]);

        DB::update('UPDATE categories SET category = ?, color = ? WHERE id = ?', [$request->category, $request->color, $category->id]);

        return redirect()->route('category.index')->with('update_success', '¡Categoría actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        DB::delete('DELETE FROM categories WHERE id = ?', [$category->id]);

        return redirect()->route('category.index')->with('update_success', '¡Categoría eliminada!');
    }
}
