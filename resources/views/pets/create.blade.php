 <h1>Dodaj nowe zwierzę</h1> <form method="POST" action="{{ route('pets.store') }}" enctype="multipart/form-data">
  @csrf <div> <label for="id">ID:</label> <input type="text" id="id" name="id"> </div>
   <div>
  <label for="category_id">Kategoria ID:</label> <input type="text" id="category_id" name="category[id]"> 
  </div> <div> <label for="category_name">Kategoria Nazwa:</label> <input type="text" id="category_name" name="category[name]"> 
  </div> <div> <label for="name">Nazwa:</label> <input type="text" id="name" name="name"> </div> <div> <label for="status">Status:</label>
   <select name="status" id="status"> <option value="available">Available</option> <option value="pending">Pending</option> <option value="sold">Sold</option> 
   </select> 
   </div> 
   <div> <label for="photoUrls">URL zdjęć:</label> <input type="text" id="photoUrls" name="photoUrls[]"> 
  </div> <div> <label for="tags">Tagi:</label> <input type="text" id="tags" name="tags[0][name]"> 

 </div> <div> <label for="file">Zdjęcie:</label>
  <input type="file" id="file" name="file">
   </div> <button type="submit">Dodaj</button> </form> <a href="{{ route('pets.index') }}">Powrót do listy</a>