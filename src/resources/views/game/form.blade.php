@extends('layout')

@section('content')
    <h1>{{ $title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif

    <form method="post" action="{{ $game->exists ? '/games/patch/' . $game->id : '/games/put' }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="game-title" class="form-label">Nosaukums</label>
            <input
                type="text"
                id="game-title"
                name="title"
                value="{{ old('title', $game->title) }}"
                class="form-control @error('title') is-invalid @enderror"
            >
            @error('title')
                <p class="invalid-feedback">{{ $errors->first('title') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="game-develepor" class="form-label">Develepor</label>
            <select
                id="game-develepor"
                name="develepor_id"
                class="form-select @error('develepor_id') is-invalid @enderror"
            >
                <option value="">Norādiet develeporu!</option>
                @foreach($develepors as $develepor)
                    <option
                        value="{{ $develepor->id }}"
                        @if ($develepor->id == old('develepor_id', $game->develepor->id ?? '')) selected @endif
                    >
                        {{ $develepor->name }}
                    </option>
                @endforeach
            </select>
            @error('develepor_id')
                <p class="invalid-feedback">{{ $errors->first('develepor_id') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="game-description" class="form-label">Apraksts</label>
            <textarea
                id="game-description"
                name="description"
                class="form-control @error('description') is-invalid @enderror"
            >{{ old('description', $game->description) }}</textarea>
            @error('description')
                <p class="invalid-feedback">{{ $errors->first('description') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="game-release-year" class="form-label">Izdošanas gads</label>
            <input
                type="number"
                max="{{ date('Y') + 1 }}"
                step="1"
                id="game-release-year"
                name="release_year"
                value="{{ old('release_year', $game->release_year) }}"
                class="form-control @error('release_year') is-invalid @enderror"
            >
            @error('release_year')
                <p class="invalid-feedback">{{ $errors->first('release_year') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="game-image" class="form-label">Attēla saite</label>
            @if ($game->image)
                <img
                    src="{{ $game->image }}"
                    class="img-fluid img-thumbnail d-block mb-2"
                    alt="{{ $game->title }}"
                    style="max-width: 200px;"
                >
            @endif
            <input
                type="text"
                id="game-image"
                name="image"
                value="{{ old('image', $game->image) }}"
                placeholder="Ievadiet attēla URL"
                class="form-control @error('image') is-invalid @enderror"
            >
            @error('image')
                <p class="invalid-feedback">{{ $errors->first('image') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="game-price" class="form-label">Cena</label>
            <input
                type="number"
                min="0.00"
                step="0.01"
                lang="en"
                id="game-price"
                name="price"
                value="{{ old('price', $game->price) }}"
                class="form-control @error('price') is-invalid @enderror"
            >
            @error('price')
                <p class="invalid-feedback">{{ $errors->first('price') }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input
                    type="checkbox"
                    id="game-is-active"
                    name="is_active"
                    value="1"
                    class="form-check-input @error('is_active') is-invalid @enderror"
                    @if (old('is_active', $game->is_active)) checked @endif
                >
                <label class="form-check-label" for="game-is-active">
                    Publicēt ierakstu
                </label>
                @error('is_active')
                    <p class="invalid-feedback">{{ $errors->first('is_active') }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $game->exists ? 'Atjaunot ierakstu' : 'Pievienot ierakstu' }}
        </button>
    </form>
@endsection
