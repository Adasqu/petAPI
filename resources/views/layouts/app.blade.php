<!DOCTYPE html>
 <html lang="en">
  <head> <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petstore API</title> <link rel="stylesheet" href="{{ asset('css/app.css') }}">
     </head> <body> <div class="container"> @if(session('success')) 
     <div class="alert alert-success"> {{ session('success') }} 
</div> 
@endif
 @if(session('error')) 
 <div class="alert alert-danger"> {{ session('error') }} </div> @endif @yield('content') </div> </body> </html>