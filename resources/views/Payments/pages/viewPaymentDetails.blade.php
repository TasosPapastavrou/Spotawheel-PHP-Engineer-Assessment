<section>

@php
    $client = $payment->client;
@endphp

<div class="d-flex justify-content-start align-items-center">    
        <div class="p-1"><h1>Payment Details</h1></div>
</div>

<table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Amount</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$client->name}}</td>
                <td>{{$client->surname}}</td>
                <td>{{$payment->amount}}</td>
                <td>{{$payment->created_at}}</td>
                <td>{{$payment->updated_at}}</td>
            </tr> 
        </tbody>
    </table>


</section>