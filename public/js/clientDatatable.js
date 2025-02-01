var url = window.location.origin;

var clientTable = $('#clients-table').DataTable({
    scrollY:        "600px",
    scrollX:        true,
    scrollCollapse: true,
    paging: true,
    serverSide: true,
    processing: true,
    columns: [ 
        { data: "name" },
        { data: "surname" },
        { 
            data: "id",
            render: function(data,type,row){
                return '<a href="'+url+'/view/client/'+data+'" class="btn btn-secondary">View</a> <a href="'+url+'/update/client/'+data+'" class="btn btn-primary">Update</a>  <a href="'+url+'/delete/client/data/'+data+'" class="btn btn-danger">Delete</a>'; 
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
        url: url+'/get/clients/datatable',
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



$('.filter-clients-by-date').on('click', function() {
    clientTable.draw();
});

$('#sortBy').on('change', function() {
    let value = $(this).val();
    
    if(value.length > 0)
       clientTable.draw();
});