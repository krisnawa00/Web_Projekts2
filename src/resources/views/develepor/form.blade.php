@extends('layout')

@section('content')
    <h1>{{ $title }}</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">Lūdzu, novērsiet radušās kļūdas!</div>
    @endif
    
    <form method="post" action="{{ $develepor->exists ? '/develepors/patch/' . $develepor->id : '/develepors/put' }}">
        @csrf
        
        <div class="mb-3">
            <label for="develepor-name" class="form-label">Develepor vārds</label>
            <input
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                id="develepor-name"
                name="name"
                value="{{ old('name', $develepor->name) }}"
            >
            @error('name')
                <p class="invalid-feedback">{{ $errors->first('name') }}</p>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">
            {{ $develepor->exists ? 'Atjaunot' : 'Pievienot' }}
        </button>
    </form>
@endsection