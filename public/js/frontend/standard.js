(function($){
    $(document).ready(function(){

        /*** Fancybox Start***/
        $(".fancybox").fancybox({
             type: "image",
             helpers: {
                 overlay: {
                     locked: false
                 }
             }
        });

        /*** Spoiler ***/
        $('.Spoiler-Caption').click(function(){
            $(this).parent().find('.Spoiler-Content').slideToggle();
        });

        /*** Tabs ***/
        $("dl.Tabs dt").click(function(){
            $(this).siblings().removeClass("Active").end()
                   .next("dd").andSelf().addClass("Active");
        });

        /*** Tootle-Next-Item ***/
        $('.Toggled-Next-Item').slideUp();
        $('.Toggle-Next-Item a').click(function(){
            $(this).parent().next().slideToggle();
            return false;
        });



        var URI = location.pathname.split('/');
        /*** Activate Current Tab ***/
        if(URI[1]){
            $('.Tab-Set a').each(function(Key,Item){

                var Crumbs = $(Item).attr('href').split('/');
                if(URI [2]){
                    if(Crumbs [1] == URI [1] && Crumbs [2] == URI [2]){
                        $(Item).addClass('Active');
                    }else{
                        $(Item).removeClass('Active');
                    }
                }else{
                    if(Crumbs [1] == URI [1] && !Crumbs [2]){
                        $(Item).addClass('Active');
                    }else{
                        $(Item).removeClass('Active');
                    }
                }
            });
        }

    });
})(jQuery);