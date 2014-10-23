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


        /*** Activate Current Tab ***/
        $('.Tab-Set a').each(function(Key,Item){
            if($(Item).attr('href') == location.pathname){
                $(Item).addClass('Active');
            }else{
                $(Item).removeClass('Active');
            }
        });

    });
})(jQuery);