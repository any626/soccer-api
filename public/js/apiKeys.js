jQuery('#key-panel').on('click', '#create-key', function(){
    var token = jQuery('#auth-token').val();
    jQuery.ajax({
        url: '/apikey/create',
        type: 'POST',
        data: {_token: token},
        dataType: 'JSON'
    }).done(function(response){
        jQuery('#key-container').append('<pre id="key">'+response.key+'</pre>');
        jQuery('#button-group')
        .html('')
        .append('<button class="btn btn-primary" id="recreate-key">Reset</button>\n<button class="btn btn-primary" id="delete-key">Delete</button>');
    }).fail(function(){
        alert('error');
    });
});

jQuery('#key-panel').on('click', '#delete-key', function(){
    var token = jQuery('#auth-token').val();
    jQuery.ajax({
        url: '/apikey/delete',
        type: 'POST',
        data: {_token: token},
        dataType: 'JSON'
    }).done(function(){
        jQuery('#button-group').html('').append('<button type="submit" class="btn btn-primary" id="create-key">Create a Key</button>');
        jQuery('#key').remove();
    }).fail(function(response){
        alert(response);
    });
});

jQuery('#key-panel').on('click', '#recreate-key', function(){
    var token = jQuery('#auth-token').val();
    jQuery.ajax({
        url: '/apikey/edit',
        type: 'POST',
        data: {_token: token},
        dataType: 'JSON'
    }).done(function(response){
        jQuery('#key').html(response.key);
    }).fail(function(response){
        alert(response);
        console.log(response);
    });
});
