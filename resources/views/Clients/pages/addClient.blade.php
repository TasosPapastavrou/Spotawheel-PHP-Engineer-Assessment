<section>


<form action="{{route('store.new.client')}}" method="post">
@csrf 
<div class="mb-3">
  <label for="name" class="form-label">Name</label>
  <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
    @if($errors->has('name'))
        <div id="validationServer03Feedback" class="invalid-feedback d-block">
            Field is empty!
        </div>
    @endif
</div>

<div class="mb-3">
  <label for="surname" class="form-label">Surname</label>
  <input type="text" class="form-control" id="surname" name="surname"  placeholder="Enter surname">
    @if($errors->has('surname'))
        <div id="validationServer03Feedback" class="invalid-feedback d-block">
            Field is empty!
        </div>
    @endif
</div>

@if(Session::has('success'))
    <div class="alert alert-success mt-3" role="alert">
        Client is saved!
    </div>
@endif

<button type="submit" class="btn btn-success">Submit</button>

</form>




</section>