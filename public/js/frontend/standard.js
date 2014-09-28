(function($){
    $(document).ready(function(){

        window.UP={};

        /* Fancybox */
        $(".fancybox").fancybox({
             type: "image",
             helpers: {
                 overlay: {
                     locked: false
                 }
             }
        });



        /* Spoiler */
        $('.Spoiler-Caption').click(function(){
            $(this).parent().find('.Spoiler-Content').slideToggle();
        });

        /* Message */
        window.UP.Message = function (event,message,type){
            if(type===undefined){
                type='success';
            }
            $('.Message').remove();

            $('body').append('<aside class="Message Bottom-Right Icon '+type+'">'+
                                  '<h4>'+event+'</h4>'+
                                  '<p>'+message+'</p>'+
                             '</aside>');
            $('.Message').effect('bounce').delay(2000).fadeOut(2000);
        }

        /* Табы */
        $("dl.Tabs dt").click(function(){
            $(this).siblings().removeClass("Active").end()
                   .next("dd").andSelf().addClass("Active");
        });

        /* Tootle-Next-Item */
        $('.Toggled-Next-Item').hide();
//        $('.Toggle-Next-Item a').click(function(){
//            $.preventDefault();
//        });
        $('.Toggle-Next-Item a').click(function(){
            $(this).parent().next().slideToggle();
            return false;
        });


    });
})(jQuery);