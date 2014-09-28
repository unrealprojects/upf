(function($){
    $(document).ready(function(){
        /*** Кнопки "Войти" и "Регистрация" ***/
        $(".Sign-In").click(function(){
            $('.Sign-Up-UI').fadeOut(100,'easeInQuint');
            $('.Sign-In-UI').fadeToggle(300,'easeInQuint');
        });
        $(".Sign-Up").click(function(){
            $('.Sign-In-UI').fadeOut(100,'easeInQuint');
            $('.Sign-Up-UI').fadeToggle(300,'easeInQuint');
        });
        $('main').click(function(){
            $('.Sign-In-UI,.Sign-Up-UI').fadeOut(100,'easeInQuint');
        });

        $(window).scroll(function(){
            /*** Paralax Top Menu ***/
            if($(window).scrollTop()>=0 && $(window).scrollTop()<350){
                scrollPos = $(this).scrollTop();
                /*** Parallax общий ***/
                $('#Page-Slider').css({
                    'height': 250 - (scrollPos * 2) + "px"
                });
                /*** Paralax кнопок ***/
                $('#Slider-Links').css({
                    'left': 400 + (scrollPos)+"px",
                    'opacity' : 1-(scrollPos/200)
                });
                /*** Paralax БелАЗа ***/
                $('#Truck').css({
                    'top' : (scrollPos * 1.2)+"px",
                    'opacity' : 1-(scrollPos/100)
                });
                /*** Paralax фона ***/
                $('#Page-Slider').css({
                    'background-position' : 'center ' + (-scrollPos/18)+"px"
                });
            }
            /*** Появление Кнопка Вверх ***/
            if(($(this).scrollTop() > 0) && ($(window).width() > 500)) {
                $('#Scroll-Top').fadeIn();
            } else {
                $('#Scroll-Top').fadeOut();
            }
        });

        /*** Скролл вверх ***/
        $('#Scroll-Top').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 400);
            return false;
        });

        /*** Мобильное меню ***/
        $('#Menu-Toggle').click(function(){
            if ( $('#Menu').is(':hidden') ) {
                $('#Menu').slideDown('slow');
            } else {
                $('#Menu').slideUp('slow');
            }
        });

        /*** window resize ***/
        $(window).resize(function(){
            if($(window).width()>1024){
                $('#Menu').show();
            }
        });

    });
})(jQuery);