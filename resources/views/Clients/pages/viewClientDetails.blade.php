<section>


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




</section>