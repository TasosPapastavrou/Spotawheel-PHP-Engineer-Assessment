<section>

@php


    $name = $client->name;
    $surname = $client->surname; 


if(old('name') || $errors->has('name'))
    $name = old('name');   
    
if(old('surname') || $errors->has('surname'))
    $surname = old('surname');   

 

@endphp

<div class="d-flex justify-content-center align-items-center">    
        <div class="p-1"><h1>Update Client</h1></div>
</div>

<form action="{{route('update.client.data',$client->id)}}" method="post">
@csrf 
<div class="mb-3">
  <label for="name" class="form-label">Name</label>
  <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{$name}}">
    @if($errors->has('name'))
        <div id="validationServer03Feedback" class="invalid-feedback d-block">
            Field is empty!
        </div>
    @endif
</div>

<div class="mb-3">
  <label for="surname" class="form-label">Surname</label>
  <input type="text" class="form-control" id="surname" name="surname"  placeholder="Enter surname" value="{{$surname}}">
    @if($errors->has('surname'))
        <div id="validationServer03Feedback" class="invalid-feedback d-block">
            Field is empty!
        </div>
    @endif
</div>

@if(Session::has('success'))
    <div class="alert alert-success mt-3" role="alert">
        Client Updated!
    </div>
@endif

<button type="submit" class="btn btn-success">Submit</button>

</form>




</section>