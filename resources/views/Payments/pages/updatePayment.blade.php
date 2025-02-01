<section>

@php

$amount = $payment->amount;
$client = $payment->client_id;
 

if(old('amount') || $errors->has('amount'))
    $amount = old('amount');   
    
if(old('client') || $errors->has('client'))
    $client = old('client');   

@endphp

<form action="{{route('update.payment.data', 1)}}" method="post">
@csrf 


    <div class="form-group mb-3">
        <label for="client" class="login-form-labels p-2">Client List</label>                                
        <select class="client--select" name="client" id="client"> <!-- form-control --> </select>   
                                        
        @if($errors->has('client') || old('client')==-1)
            <div id="validationServer03Feedback" class="invalid-feedback d-block">
                Field is empty!
            </div> 
        @else
            <input id="oldClient" type="hidden" name="oldClient" value="{{ $client }}">
        @endif
    </div>

    <div class="form-group mb-3">
        <label for="amount">Amount</label>
        <input type="number" class="form-control" id="amount" name="amount" step="0.01" placeholder="Enter an amount" value="{{ $amount }}"> 
        @if($errors->has('amount'))
            <div id="validationServer03Feedback" class="invalid-feedback d-block">
                Field is empty!
            </div>
        @endif
    </div>

@if(Session::has('success'))
    <div class="alert alert-success mt-3" role="alert">
        Payment is saved!
    </div>
@endif

<button type="submit" class="btn btn-success">Submit</button>

</form>


</section>