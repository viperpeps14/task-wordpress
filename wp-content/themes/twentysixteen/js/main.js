jQuery(document).ready(function($){
    var formData = new FormData(this);
    $('#feedback-form').submit(function(){

        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '/wp-admin/admin-ajax.php',
            data:  formData,
            processData: false,
            contentType: false,
            success: function(response){
                 var obj = jQuery.parseJSON(response);
                if(obj.result === true){
                    $('#popup-form').html("Заявка успешно отправлена!");
                }else{
                    var error_form = '<ul>';
                    for(var error_field in obj){
                        if(error_field == 'result'){
                            continue;
                        }
                        error_form = error_form +  '<li>' + obj[error_field] + '</li>';
                    }
                        error_form = error_form + '</ul>';
                    $('.error-form').html(error_form);
                }
            }
        });
    });
});