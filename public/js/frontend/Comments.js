(function($){
    $(document).ready(function(){
        /* Vote */
        $.getScript('http://www.google.com/recaptcha/api/js/recaptcha_ajax.js');

        /* Comments */
        $('.Form-Horizontal input[type=submit]').click(function(){
            var this_element = this;
            var name = $('input[name=name]',$(this_element).parent().parent()).val();
            var comment = $('textarea[name=comment]',$(this_element).parent().parent()).val();
            var list_id = $('input[name=list_id]',$(this_element).parent().parent()).val();
            var captcha = $('input[name=recaptcha_response_field]',$(this_element).parent().parent()).val();
            if(name && comment && list_id && captcha){
                $.ajax({
                    url:'/comments/add/'+list_id,
                    type:'get',
                    data:{'challenge':Recaptcha.get_challenge(),
                          'response':Recaptcha.get_response(),
                          'name':name,
                          'comment':comment},
                    dataType:'json',
                    success:function($data){
                        Recaptcha.reload();
                        UP.Message($data['Event'],$data['Message'],$data['Type']);
                        if($data['Type']=='Success'){
                            $('.Comment-List').append($('<div/>').html($data['comment']).text());
                        }
                    }
                });
            }else{
                Recaptcha.reload();
                UP.Message('Ошибка','Заполните все поля','Error');
            }
            return false;
        });
        /* End Comments */





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Vote
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var Vote_Item       = '.Item-Vote';
var Vote_Buttons    = Vote_Item + ' li a';


$(document).on('click',Vote_Buttons,function(){
    var This = this;

    var Data = {
        "action"    :   $(this).parents(Vote_Item).attr('data-action'),
        "section"   :   $(this).parents(Vote_Item).attr('data-action-section'),
        "direct"    :   $(this).attr('data-direct'),
        "alias"     :   $(this).parents(Vote_Item).attr('data-action-alias')

    };

    $.ajax({
        url:        '/vote/',
        type:       'get',
        data:       Data,
        dataType:   'json',
        success:    function(Data)
        {
            upf.Messages.Show(Data['message'],Data['type']);
            if($data['Type']=='Success'){
                $(this).parents(Vote_Item).find('.Rating').text(Data['rating']);
            }
        }

    });

    return false;
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








    });
})(jQuery);