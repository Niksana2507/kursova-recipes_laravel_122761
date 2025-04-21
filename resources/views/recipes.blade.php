@extends('layouts.app')

@section('maincontent')
<div class="recipe-form-container">
    <div class="recipe-form-card">
        <div class="recipe-form-header">
            <h3>Добавяне на рецепта</h3>
        </div>

        <div class="recipe-form-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('recipes.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="recipe-form-group">
                    <label for="title">Заглавие</label>
                    <input id="title" type="text" class="recipe-form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
                    @error('title')
                        <span class="recipe-form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="recipe-form-group">
                    <label for="description">Описание</label>
                    <textarea id="description" class="recipe-form-control @error('description') is-invalid @enderror" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="recipe-form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="recipe-form-group">
                    <label for="ingredients">Съставки</label>
                    <textarea id="ingredients" class="recipe-form-control @error('ingredients') is-invalid @enderror" name="ingredients" rows="5" placeholder="Въведете всяка съставка на нов ред">{{ old('ingredients') }}</textarea>
                    <span class="recipe-form-help">Въведете всяка съставка на нов ред</span>
                    @error('ingredients')
                        <span class="recipe-form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="recipe-form-group">
                    <label for="instructions">Инструкции за приготвяне</label>
                    <textarea id="instructions" class="recipe-form-control @error('instructions') is-invalid @enderror" name="instructions" rows="5">{{ old('instructions') }}</textarea>
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
                            <input id="prep_time" type="number" class="recipe-form-control @error('prep_time') is-invalid @enderror" name="prep_time" value="{{ old('prep_time') }}">
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
                            <input id="cook_time" type="number" class="recipe-form-control @error('cook_time') is-invalid @enderror" name="cook_time" value="{{ old('cook_time') }}">
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
                            <input id="servings" type="number" class="recipe-form-control @error('servings') is-invalid @enderror" name="servings" value="{{ old('servings') }}">
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
                    <div class="recipe-form-file-input">
                        <input id="image" type="file" class="@error('image') is-invalid @enderror" name="image">
                        <label for="image" class="recipe-form-file-label">Изберете файл</label>
                    </div>
                    <span class="recipe-form-help">Препоръчително: JPG, PNG или GIF, максимум 2MB</span>
                    @error('image')
                        <span class="recipe-form-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="recipe-form-footer">
                    <a href="{{ route('recipes.index') }}" class="recipe-btn recipe-btn-secondary">
                        <i class="fas fa-arrow-left"></i> Назад
                    </a>
                    <button type="submit" class="recipe-btn recipe-btn-primary">
                        <i class="fas fa-save"></i> Добави рецепта
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
