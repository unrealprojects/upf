(function($){
    $(document).ready(function(){

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Vote
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var Vote_Item       = '.Item-Vote';
var Vote_Buttons    = Vote_Item + ' li a';


$(document).on('click',Vote_Buttons,function(){
    var This = this;

    var Data = {
        "action"        :   $(this).parents(Vote_Item).attr('data-action'),
        "section"       :   $(this).parents(Vote_Item).attr('data-section'),
        "direct"        :   $(this).attr('data-direct'),
        "alias"         :   $(this).parents(Vote_Item).attr('data-alias'),
        "comment_id"    :   $(this).parents(Vote_Item).attr('data-comment-id')
    };

    $.ajax({
        url:        '/vote',
        type:       'post',
        data:       Data,
        dataType:   'json',
        success:    function(Data)
        {
            upf.Messages.Show(Data['Message'],Data['Type']);
            if(Data['Type']=='Success'){
                $(This).parents(Vote_Item).find('.Rating').html(Data['Rating']);

                // Set Current Value
                if(Data['Rating']>0){
                    $(This).parents(Vote_Item).find('.Rating').addClass('Positive').removeClass('Negative');
                }else if(Data['Rating']<0){
                    $(This).parents(Vote_Item).find('.Rating').addClass('Negative').removeClass('Positive');
                }else{
                    $(This).parents(Vote_Item).find('.Rating').removeClass('Positive Negative');
                }
            }
        }

    });

    return false;
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Comments
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Initialise Recaptcha
$.getScript('http://www.google.com/recaptcha/api/js/recaptcha_ajax.js');

$('.Form-Comment input[type=submit].Send-Post').click(function(){
    var This = this;
//    var list_id = $('input[name=list_id]',$(this_element).parent().parent()).val();
//    var captcha = $('input[name=recaptcha_response_field]',$(this_element).parent().parent()).val();

    var Data = {
        'Challenge':    Recaptcha.get_challenge(),
        'Response':     Recaptcha.get_response(),
        'Author':       $('input[name=author]',$(This).parents('.Form-Comment')).val(),
        'Post':         $('textarea[name=post]',$(This).parents('.Form-Comment')).val(),
        'Section':      $(This).parents('.Form-Comment').attr('data-section'),
        'Alias':        $(This).parents('.Form-Comment').attr('data-alias'),
        'Wall-Id':      $(This).parents('.Form-Comment').attr('data-wall-id')
    };

    if(Data['Challenge'] && Data['Response'] && Data['Author'] && Data['Post'] && Data['Section'] && Data['Alias']){
        $.ajax({
            url:        '/comments',
            type:       'post',
            data:       Data,
            dataType:   'json',
            success:    function(Data)
            {
                upf.Messages.Show(Data['Message'],Data['Type']);
                if(Data['Type']=='Success')
                {
                    $('.Comments').append($('<div/>').html(Data['Post']).text());
                }
                Recaptcha.reload();
            }
        });
    }
    else
    {
        Recaptcha.reload();
        upf.Messages.Show('Ошибка при отправке сообщения, проверьте все поля.','Error');
    }
    return false;
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




    });
})(jQuery);