@extends('layouts.app') 
@section('content') 
<h1>Available Pets</h1> 
 <form method="GET" action="{{ route('pets.index') }}"> 
 <label for="status">Filtruj według statusu:</label> 
 <select name="status" id="status"> 
 <option value="available" {{ $status == 'available' ? 'selected' : '' }}>Dostępne</option> 
 <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Oczekujące</option> 
 <option value="sold" {{ $status == 'sold' ? 'selected' : '' }}>Sprzedane</option>
 </select> <button type="submit">Filtruj</button> </form>
  <form method="GET" action="{{ route('pets.index') }}"> <label for="id">Wyszukaj według ID:</label> <input type="text" name="id" id="id"> <button type="submit">Wyszukaj</button> </form>
<ul> 
 @foreach ($pets as $pet) 
 <li> 
 <a href="{{ route('pets.show', $pet['id']) }}">{{ $pet['name']?? '' }}</a> 
 <p>Kategoria: {{ $pet['category']['name'] ?? 'Brak' }}</p>
 <p>Status: {{ $pet['status'] }}</p>
  @if (!empty($pet['photoUrls'])) 
 <p>Zdjęcia:</p> <ul> @foreach ($pet['photoUrls'] as $photoUrl)
  <li><img src="{{ $photoUrl }}" alt="{{ $pet['name'] }}" width="100"></li>
   @endforeach 
   </ul>
    @endif 
    </li> 
    @endforeach 
    </ul> 
@endsection