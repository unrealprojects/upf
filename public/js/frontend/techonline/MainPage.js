(function($){
    $(document).ready(function(){
        /* Фильтh::Табы */
        $("dl.Tabs dt").click(function(){
            $(this).siblings().removeClass("Active").end()
                       .next("dd").andSelf().addClass("Active");
        });
    });
})(jQuery);