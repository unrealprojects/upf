(function($){
    $(document).ready(function(){

        $('.Accordion > .Accordion-Subcategory:nth-of-type(2)').show();
        $('.Filter-Subcategory:visible').prev().find('span').removeClass('fa-angle-down').addClass('fa-angle-up');
        $('.Accordion > .Accordion-Subheader > .Accordion-Switch').click(function(){
            var selfClick = $(this).parent()
                                   .next()
                                   .is(':visible');

            if(!selfClick) {
                $(this).parent().parent()
                       .find('.Accordion-Subcategory:visible')
                       .slideToggle().find('span');
            }

            $(this).parent()
                   .next('.Accordion-Subcategory')
                   .stop(true, true)
                   .slideToggle(function(){
                        $('.Accordion-Switch span').addClass('fa-angle-down');
                        $('.Filter-Subcategory:visible').prev().find('span').removeClass('fa-angle-down').addClass('fa-angle-up');
                    });

        });
    });
})(jQuery);
