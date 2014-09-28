(function($){
    $(document).ready(function(){
        /* Vote */
        $.getScript('http://www.google.com/recaptcha/api/js/recaptcha_ajax.js');

        $(document).on('click','.Comment-List-Element .Up',function(){
            comment_id=$(this).parent().parent().parent().attr('comment_id');
            var this_element = this;
            $.ajax({
                url:'/vote/up/comments/'+comment_id,
                type:'get',
                dataType:'json',
                success:function($data){
                    UP.Message($data['Event'],$data['Message'],$data['Type']);
                    if($data['Type']=='Success'){
                        $('.Value',$(this_element).parent()).text(parseInt($('.Value',$(this_element).parent()).text())+1);
                    }
                }
            });
        });

        $(document).on('click','.Comment-List-Element .Down',function(){
            comment_id=$(this).parent().parent().parent().attr('comment_id');
            var this_element = this;
            $.ajax({
                url:'/vote/down/comments/'+comment_id,
                type:'get',
                dataType:'json',
                success:function($data){
                    UP.Message($data['Event'],$data['Message'],$data['Type']);
                    if($data['Type']=='Success'){
                        $('.Value',$(this_element).parent()).text(parseInt($('.Value',$(this_element).parent()).text())-1);
                    }
                }
            });
        });

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
    });
})(jQuery);