@extends('layout')

@section('content')
    <h1>{{ $title }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif

    <form method="post" action="{{ $genre->exists ? '/genres/patch/' . $genre->id : '/genres/put' }}">
        @csrf

        <div class="mb-3">
            <label for="genre-name" class="form-label">Nosaukums</label>
            <input
                type="text"
                id="genre-name"
                name="name"
                value="{{ old('name', $genre->name) }}"
                class="form-control @error('name') is-invalid @enderror"
            >
            @error('name')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="genre-description" class="form-label">Apraksts</label>
            <textarea
                id="genre-description"
                name="description"
                class="form-control @error('description') is-invalid @enderror"
            >{{ old('description', $genre->description) }}</textarea>
            @error('description')
                <p class="invalid-feedback">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input
                    type="checkbox"
                    id="genre-active"
                    name="is_active"
                    value="1"
                    class="form-check-input @error('is_active') is-invalid @enderror"
                    @if (old('is_active', $genre->is_active)) checked @endif
                >
                <label class="form-check-label" for="genre-active">
                    Publicēt žanru
                </label>
                @error('is_active')
                    <p class="invalid-feedback">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            {{ $genre->exists ? 'Atjaunot žanru' : 'Pievienot žanru' }}
        </button>
    </form>
@endsection
