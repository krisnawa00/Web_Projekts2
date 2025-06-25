@extends('layout')

@section('content')
<h1>{{ $title }}</h1>

@if (count($items) > 0)
 <table class="table table-sm table-hover table-striped">
 <thead class="thead-light">
 <tr>
   <th>ID</th>
   <th>Nosaukums</th>
   <th>Apraksts</th>
   <th>Spēle</th>
   <th>Aktīvs</th>
   <th>&nbsp;</th>
 </tr>
 </thead>
 <tbody>
 @foreach($items as $genre)
 <tr>
   <td>{{ $genre->id }}</td>
   <td>{{ $genre->name }}</td>
   <td>{{ $genre->description }}</td>
   <td>{{ $genre->game->title ?? '—' }}</td>
   <td>{!! $genre->is_active ? '&#x2714;' : '&#x274C;' !!}</td>
   <td>
     <a
       href="/genres/update/{{ $genre->id }}"
       class="btn btn-outline-primary btn-sm"
     >Labot</a> /
     <form
       method="post"
       action="/genres/delete/{{ $genre->id }}"
       class="d-inline deletion-form"
     >
       @csrf
       <button
         type="submit"
         class="btn btn-outline-danger btn-sm"
       >Dzēst</button>
     </form>
   </td>
 </tr>
 @endforeach
 </tbody>
 </table>
@else
 <p>Nav atrasts neviens ieraksts</p>
@endif

<a href="/genres/create" class="btn btn-primary">Pievienot jaunu</a>
@endsection
