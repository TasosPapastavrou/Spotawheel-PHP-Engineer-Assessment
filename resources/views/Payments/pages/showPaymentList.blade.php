<section>

    <div class="notification-box">
        @if($errors->has('error_delete'))
            <div class="alert alert-danger mt-3" role="alert">
                The payment did not deleted!
            </div>
        @endif

        @if(Session::has('success'))
            <div class="alert alert-success mt-3" role="alert">
                Payment is deleted!
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-center align-items-center">    
        <div class="p-1"><h1>Payments List</h1></div>
    </div>

    <div class="d-flex justify-content-start align-items-center">    
        <div class="p-1"><h1>Filters</h1></div>
    </div>

    <div class="d-flex justify-content-start align-items-center flex-wrap">
        <div class="p-1"> 
            <label for="fromDate">Select Date from:</label>
            <input type="date" id="fromDate" name="fromdate"> 
        </div>
        <div class="p-1">
            <label for="toDate">Select Date to:</label>
            <input type="date" id="toDate" name="toDate">
        </div>
        <div class="p-1"><button class="filter-payments-by-date">Submit</button></div>

        <div class="p-1">
            <label for="sortBy">Sort by:</label>
            <select id="sortBy" name="sortBy">
                <option value="">No Sorted</option>
                <option value="asc">Sorted By Oldest</option>
                <option value="desc">Sorted By Newest</option>
            </select>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <div> <a class="btn bg-primary m-1 text-white" href="{{ route('add.payment') }}">Add Payment</a> </div> 
    </div>

    <table id="payments-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Surname</th>
                <th>Amount</th>
                <th>Actions</th>
                <th>date</th> 
            </tr>
        </thead>
    </table>

</section>