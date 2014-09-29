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