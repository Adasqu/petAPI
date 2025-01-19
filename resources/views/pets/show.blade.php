@extends('layouts.app') 
@section('content') 
 <h1>{{ $pet['name']?? ''  }}</h1> 
 <p>ID: {{ $pet['id'] }}</p>
  <form method="POST" action="{{ route('pets.update', $pet['id']) }}">
   @csrf 
   @method('PUT') 
   <div> <label for="name">Nazwa:</label> <input type="text" id="name" name="name" value="{{ $pet['name'] ?? '' }}"> 
   <div> <label for="name">Nazwa:</label> <input type="text" id="name" name="name" value="{{ $pet['name'] ?? '' }}"> 
   </div> <div> <label for="category">Kategoria:</label>
    <input type="text" id="category" name="category" value="{{ $pet['category']['name'] ?? '' }}">
    </div> <div> <label for="status">Status:</label> <select name="status" id="status"> <option value="available" {{ $pet['status'] == 'available' ? 'selected' : '' }}>Available</option>
     <option value="pending" {{ $pet['status'] == 'pending' ? 'selected' : '' }}>Pending</option> <option value="sold" {{ $pet['status'] == 'sold' ? 'selected' : '' }}>Sold</option> </select>
      </div> <div> <label for="photoUrls">URL zdjęć:</label> <input type="text" id="photoUrls" name="photoUrls[]" value="{{ $pet['photoUrls'][0] ?? '' }}"> 
        </div> <div> <label for="tags">Tagi:</label> <input type="text" id="tags" name="tags[]" value="{{ $pet['tags'][0]['name'] ?? '' }}"> 
 </div>
  <button type="submit">Zaktualizuj</button> </form> 
  <a href="{{ route('pets.index') }}">Powrót do listy</a>
   @endsection