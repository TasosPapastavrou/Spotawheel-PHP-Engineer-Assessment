

    var url = window.location.origin;

    if($( "#oldClient" ).val()){
        var oldClient = $( "#oldClient" ).val(); 
    }



    $.ajax({
        url: url+'/get/payment/json',
        data: {
            'type':oldClient
        },
        success: function(results){
            
            let data = results['data'];
            let selected = results['selected'];
            
            if(selected)
                data.unshift({id: -1, text: '', selected: 'selected', search:'', hidden:true });
            
            var clientSelet2 = $('.client--select').select2({ 
                width: '100%',
                placeholder: {
                    id: "-1",
                    text: "Select Client",
                    selected:'selected'
                },
                data: data,
            });

        }

    });
