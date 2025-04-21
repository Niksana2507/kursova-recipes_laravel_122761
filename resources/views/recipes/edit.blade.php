@extends('layouts.app')

@section('maincontent')
<div class="recipe-form-container">
    <div class="recipe-form-card">
        <div class="recipe-form-header">
            <h3>Редактиране на рецепта</h3>
        </div>

        <div class="recipe-form-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('recipes.update', $recipe) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="recipe-form-group">
                    <label for="title">Заглавие</label>
                    <input id="title" type="text" class="recipe-form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $recipe->title) }}" required autocomplete="title" autofocus>
                    @error('title')
                        <span class="recipe-form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="recipe-form-group">
                    <label for="description">Описание</label>
                    <textarea id="description" class="recipe-form-control @error('description') is-invalid @enderror" name="description" rows="3">{{ old('description', $recipe->description) }}</textarea>
                    @error('description')
                        <span class="recipe-form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="recipe-form-group">
                    <label for="ingredients">Съставки</label>
                    <textarea id="ingredients" class="recipe-form-control @error('ingredients') is-invalid @enderror" name="ingredients" rows="5" placeholder="Въведете всяка съставка на нов ред">{{ old('ingredients', $recipe->ingredients) }}</textarea>
                    <span class="recipe-form-help">Въведете всяка съставка на нов ред</span>
                    @error('ingredients')
                        <span class="recipe-form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="recipe-form-group">
                    <label for="instructions">Инструкции за приготвяне</label>
                    <textarea id="instructions" class="recipe-form-control @error('instructions') is-invalid @enderror" name="instructions" rows="5">{{ old('instructions', $recipe->instructions) }}</textarea>
                    @error('instructions')
                        <span class="recipe-form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="recipe-form-row">
                    <div class="recipe-form-col">
                        <div class="recipe-form-group">
                            <label for="prep_time">Време за подготовка (мин.)</label>
                            <input id="prep_time" type="number" class="recipe-form-control @error('prep_time') is-invalid @enderror" name="prep_time" value="{{ old('prep_time', $recipe->prep_time) }}">
                            @error('prep_time')
                                <span class="recipe-form-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="recipe-form-col">
                        <div class="recipe-form-group">
                            <label for="cook_time">Време за готвене (мин.)</label>
                            <input id="cook_time" type="number" class="recipe-form-control @error('cook_time') is-invalid @enderror" name="cook_time" value="{{ old('cook_time', $recipe->cook_time) }}">
                            @error('cook_time')
                                <span class="recipe-form-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="recipe-form-col">
                        <div class="recipe-form-group">
                            <label for="servings">Порции</label>
                            <input id="servings" type="number" class="recipe-form-control @error('servings') is-invalid @enderror" name="servings" value="{{ old('servings', $recipe->servings) }}">
                            @error('servings')
                                <span class="recipe-form-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="recipe-form-group">
                    <label for="image">Снимка</label>
                    <input id="image" type="file" class="recipe-form-control @error('image') is-invalid @enderror" name="image">
                    @error('image')
                        <span class="recipe-form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    @if($recipe->image)
                        <div class="recipe-form-current-image">
                            <img src="{{ asset('storage/' . $recipe->image) }}" alt="Текуща снимка">
                            <span>Текуща снимка</span>
                        </div>
                    @endif
                </div>

                <div class="recipe-form-footer">
                    <a href="{{ route('recipes.show', $recipe) }}" class="recipe-btn recipe-btn-secondary">
                        <i class="fas fa-arrow-left"></i> Назад
                    </a>
                    <button type="submit" class="recipe-btn recipe-btn-primary">
                        <i class="fas fa-save"></i> Запази промените
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 