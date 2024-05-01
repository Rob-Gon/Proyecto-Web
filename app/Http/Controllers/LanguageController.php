<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::all();

        if(empty(session('selected_language_id'))) {
            session(['selected_language_id' => 3, 'selected_language_name' => "Inglés UK", 'selected_language_flag' => "english_uk.png"]);
        }

        if(session('user_isPremium') === 1) {
            return view('language_selector', ['languages' => $languages]);
        }
        
        $languages = Language::whereIn('id', [5, 7])->get();
        return view('language_selector', ['languages' => $languages]);
    }

    public function select(Request $request)
    {
        $request->validate([
            'language_id' => 'required',
        ]);

        $language = Language::find($request->language_id);
    
        session(['selected_language_id' => $language->id, 'selected_language_name' => $language->language, 'selected_language_flag' => $language->flag]);
    
        return redirect()->back()->with('success', 'Idioma seleccionado correctamente.');
    }
}
