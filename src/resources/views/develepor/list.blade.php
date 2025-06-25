@extends('layout')
 
@section('content')
    <h1>{{ $title }}</h1>
 
    @if (count($items) > 0)
        <table class="table table-striped table-hover table-sm">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Vārds</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $develepor)
                <tr>
                    <td>{{ $develepor->id }}</td>
                    <td>{{ $develepor->name }}</td>
                    <td>
                        <a href="/develepors/update/{{ $develepor->id }}" class="btn btn-outline-primary btn-sm">Labot</a>
                        /
                        <form action="/develepors/delete/{{ $develepor->id }}" method="post" class="deletionform d-inline">
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
    
    <a href="/develepors/create" class="btn btn-primary">Izveidot jaunu</a>
@endsection