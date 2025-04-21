@extends('layouts.app')

@section('maincontent')
<div class="recipe-detail-container">
    <div class="recipe-detail-header">
        <div class="recipe-detail-title">
            <h1>{{ $recipe->title }}</h1>
        </div>
        <div class="recipe-detail-actions">
            @if(auth()->id() === $recipe->user_id)
                <a href="{{ route('recipes.edit', $recipe) }}" class="recipe-btn recipe-btn-edit">
                    <i class="fas fa-edit"></i> Редактирай
                </a>
                <form action="{{ route('recipes.destroy', $recipe) }}" method="POST" class="recipe-delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="recipe-btn recipe-btn-delete" onclick="return confirm('Сигурни ли сте, че искате да изтриете тази рецепта?')">
                        <i class="fas fa-trash"></i> Изтрий
                    </button>
                </form>
            @endif
        </div>
    </div>

    <div class="recipe-detail-content">
        <div class="recipe-detail-main">
            <div class="recipe-detail-image">
                @if($recipe->image)
                    <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}">
                @else
                    <div class="recipe-detail-placeholder">
                        <i class="fas fa-utensils"></i>
                    </div>
                @endif
            </div>

            <div class="recipe-detail-info">
                <div class="recipe-detail-meta">
                    <div class="recipe-meta-item">
                        <i class="far fa-clock"></i>
                        <span>Подготовка: {{ $recipe->prep_time }} мин.</span>
                    </div>
                    <div class="recipe-meta-item">
                        <i class="fas fa-fire"></i>
                        <span>Готвене: {{ $recipe->cook_time }} мин.</span>
                    </div>
                    <div class="recipe-meta-item">
                        <i class="fas fa-users"></i>
                        <span>Порции: {{ $recipe->servings }}</span>
                    </div>
                </div>

                <div class="recipe-detail-description">
                    <h3>Описание</h3>
                    <p>{{ $recipe->description }}</p>
                </div>
            </div>
        </div>

        <div class="recipe-detail-sections">
            <div class="recipe-detail-ingredients">
                <h3>Съставки</h3>
                <ul class="recipe-ingredients-list">
                    @foreach(explode("\n", $recipe->ingredients) as $ingredient)
                        <li>{{ trim($ingredient) }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="recipe-detail-instructions">
                <h3>Инструкции за приготвяне</h3>
                <ol class="recipe-instructions-list">
                    @foreach(explode("\n", $recipe->instructions) as $instruction)
                        <li>{{ trim($instruction) }}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>

    <div class="recipe-detail-footer">
        <a href="{{ route('recipes.index') }}" class="recipe-btn recipe-btn-secondary">
            <i class="fas fa-arrow-left"></i> Назад към рецептите
        </a>
    </div>
</div>
@endsection 