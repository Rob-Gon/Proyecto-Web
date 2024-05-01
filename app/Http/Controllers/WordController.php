<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\Category;
use App\Models\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $words = DB::select('SELECT * FROM words WHERE user_id = ?', [session('user_id')]);
        $categories = DB::select('SELECT * FROM categories WHERE user_id = ?', [session('user_id')]);
        $translations = DB::select('SELECT * FROM translations');

        return view('word.index', ['words' => $words, 'categories' => $categories, 'translations' => $translations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $words = DB::select('SELECT * FROM words WHERE user_id = ?', [session('user_id')]);
        $categories = DB::select('SELECT * FROM categories WHERE user_id = ?', [session('user_id')]);
        $translations = DB::select('SELECT * FROM translations');

        return view('word.create', ['words' => $words, 'categories' => $categories, 'translations' => $translations]);
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'word' => 'required|max:255',
            'example' => 'max:255',
            'category_id' => 'required',
            'translation' => 'required|max:255',
        ]);
    
        // Verificar si la palabra ya existe en la base de datos para el usuario actual
        $word = DB::select('SELECT * FROM words WHERE word = ? AND language_id = ? AND user_id = ?', [
            $request->word,
            $request->language_id,
            session('user_id')
        ]);
    
        if (!empty($word)) {
            // Si la palabra existe, verificar si la traducción ya existe para la palabra
            $translation = DB::select('SELECT * FROM translations WHERE word_id = ? AND translation = ?', [
                $word[0]->id,
                $request->translation
            ]);

            if (empty($translation)) {
                // Si la traducción no existe, agregarla
                DB::insert('INSERT INTO translations (translation, word_id) VALUES (?, ?)', [
                    $request->translation,
                    $word[0]->id
                ]);

                return redirect()->route('word.create')->with('store_success', '¡Nueva traducción agregada!');
            }
        } else {
            // Si la palabra no existe, agregarla junto con la traducción
            $wordId = DB::table('words')->insertGetId([
                'word' => $request->word,
                'example' => $request->example,
                'category_id' => $request->category_id,
                'language_id' => $request->language_id,
                'user_id' => session('user_id'),
            ]);
    
            DB::insert('INSERT INTO translations (translation, word_id) VALUES (?, ?)', [
                $request->translation,
                $wordId
            ]);
    
            return redirect()->route('word.create')->with('store_success', '¡Palabra agregada!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Word $word)
    {
        $word = DB::selectOne('SELECT * FROM words WHERE id = ?', [$word->id]);
        $wordCategory = DB::selectOne('SELECT * FROM categories WHERE id = ?', [$word->category_id]);
        $categories = DB::select('SELECT * FROM categories WHERE id != ?', [$wordCategory->id]);
        $translations = DB::select('SELECT * FROM translations WHERE word_id = ?', [$word->id]);

        return view('word.show', compact('word', 'wordCategory', 'categories', 'translations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Word $word)
    {
        $request->validate([
            'word' => 'required|min:1|max:255',
            'example' => 'max:255',
            'category_id' => 'required',
            'translations.*' => 'required',
        ]);

        DB::update('UPDATE words SET word = ?, example = ?, category_id = ? WHERE id = ?', [$request->word, $request->example, $request->category_id, $word->id]);

        foreach ($request->translations as $translationId => $translationValue) {
            DB::update('UPDATE translations SET translation = ? WHERE id = ?', [$translationValue, $translationId]);
        }

        return redirect()->route('word.index')->with('update_success', '¡Palabra actualizada!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Word $word)
    {
        DB::delete('DELETE FROM words WHERE id = ?', [$word->id]);

        return redirect()->route('word.index')->with('update_success', '¡Palabra eliminada!');
    }

    /**
     * Filter the words by categories.
     */
    public function filter(Request $request)
    {
        $words = DB::select('SELECT * FROM words WHERE category_id = ?', [$request->category]);
        $dropdownName = DB::selectOne('SELECT category FROM categories WHERE id = ?', [$request->category])->category;
        $categories = DB::select('SELECT * FROM categories WHERE user_id = ?', [session('user_id')]);
        $translations = DB::select('SELECT * FROM translations');

        return view('word.filter', compact('words', 'dropdownName', 'categories', 'translations'));
    }
}
