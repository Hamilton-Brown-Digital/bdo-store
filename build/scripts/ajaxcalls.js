jQuery(document).ready( function($) {

    function upvote(self){
        var post_id = $(self).attr( 'id' );
        $.ajax({
            type: 'POST',
            url: ajax_object.ajaxurl,
            data: {
                action: 'upvote_update',
                post_id: post_id
            },
            success: function(response){
                $(self).next('.voting__counter').text(response);
            }
        });
    }

    $('body').on('click', function(target){
        targetelem = target.target;
        targetbutton = targetelem.closest('button');
        if ($(targetbutton).hasClass('voting__button')){
            upvote(targetbutton);
        }
    })

    $('input:radio[name="filter"]').on('change',function(evt){
        var target = evt.target;
        var targetvalue = $(target).attr('value');
        console.log(targetvalue);
        var label = $(target).parent('label');
        $('.filter__select').removeClass('filter__select__active');
        $(label).addClass('filter__select__active');
        if (document.body.classList.contains('post-type-archive-confessions')){
            var posttype = 'confessions';
        } else if (document.body.classList.contains('post-type-archive-rants')){
            var posttype = 'rants';
        }
        $.ajax({
            type: 'POST',
            url: ajax_object.ajaxurl,
            dataType: 'html',
            data: {
                action: 'orderbyconfessions',
                selection: targetvalue,
                posttype: posttype
            },
            success: function(response) {
                $('.posts-list--stacked').html(response);
            }
        });
    });
});