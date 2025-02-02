<section>


<div class="d-flex justify-content-start align-items-center">    
        <div class="p-1"><h1>Client Details</h1></div>
</div>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$client->name}}</td>
                <td>{{$client->surname}}</td>
                <td>{{$client->created_at}}</td>
                <td>{{$client->updated_at}}</td>
            </tr> 
        </tbody>
    </table>

<div class="d-flex justify-content-start align-items-center">    
    <div class="p-1"><h1>Client Payments</h1></div>
</div>


<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Amount</th> 
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach($client->payments as $payment)
        <tr>
            <td>{{$payment->amount}}</td> 
            <td>{{$payment->created_at}}</td>
            <td>{{$payment->updated_at}}</td>
        </tr> 
        @endforeach
    </tbody>
</table>

</section>