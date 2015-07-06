



function createCategory(form) {

    if($(form).find('.has-error').length) {
        return false;
    }

    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function(data) {
            if(data.error){
                $('.field-blogterms-name').addClass('has-error');
                $('.field-blogterms-name .help-block').text(data.error.name);
            }
            if(data.success){
                $('#blogterms-name').val('');
                $('#categories-con').append('<label><input type=\"checkbox\" name=\"categories[]\" checked=\"checked\" value=\"'+data.model.id+'\"> '+data.model.name+'</label>');
                $('#myModal').modal('hide');
            }
        }
    });

    return false;
}





function insertComment(form) {

    if($(form).find('.has-error').length) {
        return false;
    }

    $.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function(data) {
            if(data.success){
                $('#commentForm').hide(function(){
                    $('#commentThanks').show();
                });
            }
        }
    });

    return false;

}


$(function() {


    /* Toggle Create Form
     *
     * Show and hide create category form
     *
    $('#add-category').click(function(e){
        e.preventDefault();
        $('#create-category-form').toggle();
    });*/



    $('#create_category').submit(function(e){

        e.preventDefault();
        e.stopImmediatePropagation();

        createCategory($(this));

    });



    $('#add_comment').submit(function(e){

        e.preventDefault();
        e.stopImmediatePropagation();

        insertComment($(this));

    });



});
