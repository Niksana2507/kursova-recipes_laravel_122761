<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class RecipeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $recipes = Recipe::latest()->paginate(10);
        return view('recipes.index', compact('recipes'));
    }

  
    public function create()
    {
        return view('recipes');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer|min:1',
            'cook_time' => 'nullable|integer|min:1',
            'servings' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('recipe-images', 'public');
            $data['image'] = $imagePath;
        }
        
        $data['user_id'] = Auth::id();
        
        Recipe::create($data);
        
        return redirect()->route('recipes.index')
            ->with('status', 'Рецептата е добавена успешно!');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified recipe.
     */
    public function edit(Recipe $recipe)
    {
        if (Auth::id() !== $recipe->user_id) {
            return redirect()->route('recipes.index')
                ->with('error', 'Нямате право да редактирате тази рецепта!');
        }
        
        return view('recipes.edit', compact('recipe'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        // Проверка дали потребителят е собственик на рецептата
        if (Auth::id() !== $recipe->user_id) {
            return redirect()->route('recipes.index')
                ->with('error', 'Нямате право да редактирате тази рецепта!');
        }
        
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer|min:1',
            'cook_time' => 'nullable|integer|min:1',
            'servings' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Обработка на изображение, ако е качено ново
        if ($request->hasFile('image')) {
            // Изтриване на старото изображение, ако съществува
            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }
            
            $imagePath = $request->file('image')->store('recipe-images', 'public');
            $data['image'] = $imagePath;
        }
        
        $recipe->update($data);
        
        return redirect()->route('recipes.index')
            ->with('status', 'Рецептата е обновена успешно!');
    }


    public function destroy(Recipe $recipe)
    {
        // Проверка дали потребителят е собственик на рецептата
        if (Auth::id() !== $recipe->user_id) {
            return redirect()->route('recipes.index')
                ->with('error', 'Нямате право да изтриете тази рецепта!');
        }
        
        // Изтриване на изображението, ако съществува
        if ($recipe->image) {
            Storage::disk('public')->delete($recipe->image);
        }
        
        $recipe->delete();
        
        return redirect()->route('recipes.index')
            ->with('status', 'Рецептата е изтрита успешно!');
    }
} 