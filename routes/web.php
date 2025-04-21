<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/login', [AuthController::class, 'showLoginForm'
])->name('login');

Route::get('/register', [AuthController::class, 'showRegistrationForm'
])->name('register');

Route::POST('/login', [AuthController::class, 'login']);
Route::POST('/register', [AuthController::class, 'register']);
Route::POST('/logout', [AuthController::class, 'logout'])->name('logout');


// Маршрутизиране за рецепти
Route::get('/recipes', [RecipeController::class, 'index'
])->name('recipes.index');
Route::get('/recipes/create', [RecipeController::class, 'create'
])->name('recipes.create');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'
])->name('recipes.show');
Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'
])->name('recipes.edit');
Route::put('/recipes/{recipe}', [RecipeController::class, 'update'
])->name('recipes.update');

Route::POST('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');


