jQuery("#create-key").click(function(){
    var token = jQuery('#auth-token').val();
    jQuery.ajax({
        url: '/apikey/create',
        type: 'POST',
        data: {_token: token},
        dataType: 'JSON'
    }).done(function(){
        alert('successful');
    }).fail(function(){
        alert('error');
    });
});

jQuery("#delete-key").click(function(){
    var token = jQuery('#auth-token').val();
    jQuery.ajax({
        url: '/apikey/delete',
        type: 'POST',
        data: {_token: token},
        dataType: 'JSON'
    }).done(function(){
        alert('successful');
    }).fail(function(response){
        alert(response);
    });
});

jQuery("#recreate-key").click(function(){
    var token = jQuery('#auth-token').val();
    jQuery.ajax({
        url: '/apikey/edit',
        type: 'POST',
        data: {_token: token},
        dataType: 'JSON'
    }).done(function(){
        alert('successful');
    }).fail(function(response){
        alert(response);
        console.log(response);
    });
});
