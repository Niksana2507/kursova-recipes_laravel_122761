@extends('layouts.app')

@section('maincontent')
<div class="recipe-list-container">
    <div class="recipe-list-header">
        <h2>Рецепти</h2>
        <a href="{{ route('recipes.create') }}" class="recipe-btn recipe-btn-primary">
            <i class="fas fa-plus"></i> Добави нова рецепта
        </a>
    </div>

    @if($recipes->isEmpty())
        <div class="recipe-empty-state">
            <i class="fas fa-utensils"></i>
            <p>Все още няма добавени рецепти.</p>
        </div>
    @else
        <div class="recipe-grid">
            @foreach($recipes as $recipe)
                <div class="recipe-card">
                    <div class="recipe-card-image">
                        @if($recipe->image)
                            <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}">
                        @else
                            <div class="recipe-card-placeholder">
                                <i class="fas fa-utensils"></i>
                            </div>
                        @endif
                    </div>
                    <div class="recipe-card-content">
                        <h3 class="recipe-card-title">{{ $recipe->title }}</h3>
                        <p class="recipe-card-description">{{ Str::limit($recipe->description, 100) }}</p>
                        <div class="recipe-card-meta">
                            <span class="recipe-card-time">
                                <i class="far fa-clock"></i>
                                {{ $recipe->prep_time + $recipe->cook_time }} мин.
                            </span>
                            <span class="recipe-card-servings">
                                <i class="fas fa-users"></i>
                                {{ $recipe->servings }} порции
                            </span>
                        </div>
                        <div class="recipe-card-footer">
                            <a href="{{ route('recipes.show', $recipe) }}" class="recipe-btn recipe-btn-secondary">Детайли</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="recipe-pagination">
            {{ $recipes->links() }}
        </div>
    @endif
</div>
@endsection 