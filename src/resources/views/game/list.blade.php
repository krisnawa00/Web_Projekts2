@extends('layout')

@section('content')
<h1>{{ $title }}</h1>

@if (count($items) > 0)
    <table class="table table-sm table-hover table-striped">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Nosaukums</th>
                <th>Izstrādātāji</th>
                <th>Gads</th>
                <th>Cena</th>
                <th>Ir aktīvs</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $game)
            <tr>
                <td>{{ $game->id }}</td>
                <td>{{ $game->title }}</td> {{-- changed from name to title --}}
                <td>{{ $game->develepor->name }}</td>
                <td>{{ $game->release_year }}</td> {{-- changed from year to release_year --}}
                <td>&euro; {{ number_format($game->price, 2, ',', ' ') }}</td>
                <td>{!! $game->is_active ? '&#x2714;' : '&#x274C;' !!}</td> {{-- changed from display to is_active --}}
                <td>
                    <a href="/games/update/{{ $game->id }}" class="btn btn-outline-primary btn-sm">Labot</a>
                    /
                    <form method="post" action="/games/delete/{{ $game->id }}" class="d-inline deletion-form">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Dzēst</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>Nav atrasts neviens ieraksts</p>
@endif

<a href="/games/create" class="btn btn-primary">Pievienot jaunu</a>
@endsection
