var url = window.location.origin;

var paymentTable = $('#payments-table').DataTable({
    scrollY:        "600px",
    scrollX:        true,
    scrollCollapse: true,
    paging: true,
    serverSide: true,
    processing: true,
    columns: [ 
        { data: "name" },
        { data: "surname" },
        { data: "amount" },
        { 
            data: "id",
            render: function(data,type,row){
                return '<a href="'+url+'/view/payment/'+data+'" class="btn btn-secondary">View</a> <a href="'+url+'/update/payment/'+data+'" class="btn btn-primary">Update</a>  <a href="'+url+'/delete/payment/data/'+data+'" class="btn btn-danger">Delete</a>'; 
            }
        },
        { 
            data: "created_at",
            render: function(data,type,row){
                let date = new Date(data);
                let formattedDate = date.getFullYear() + '-'
                + ('0' + (date.getMonth() + 1)).slice(-2) + '-'
                + ('0' + date.getDate()).slice(-2) + ' '
                + ('0' + date.getHours()).slice(-2) + ':'
                + ('0' + date.getMinutes()).slice(-2) + ':'
                + ('0' + date.getSeconds()).slice(-2);
                return formattedDate; 

            }
        }
    ],
    ajax: {
        url: url+'/get/payments/datatable',
        type: "POST", 
        data: function(d) { 
            d.startDate = $('#fromDate').val();
            d.endDate = $('#toDate').val();
            d.sort = $('#sortBy').val();
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), 
        },
    },
});



$('.filter-payments-by-date').on('click', function() {
    paymentTable.draw();
});

$('#sortBy').on('change', function() {
    let value = $(this).val();
    
    if(value.length > 0)
        paymentTable.draw();
});