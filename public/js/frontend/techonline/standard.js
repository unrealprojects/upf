(function ($)
{
    $(document).ready(function ()
    {


        /*** Buttons LogIn - LogOut ***/
        $(".Sign-In").click(function ()
        {
            $('.Sign-Up-UI').fadeOut(100, 'easeInQuint');
            $('.Sign-In-UI').fadeToggle(300, 'easeInQuint');
        });

        $(".Sign-Up").click(function ()
        {
            $('.Sign-In-UI').fadeOut(100, 'easeInQuint');
            $('.Sign-Up-UI').fadeToggle(300, 'easeInQuint');
        });

        $('main').click(function ()
        {
            $('.Sign-In-UI,.Sign-Up-UI').fadeOut(100, 'easeInQuint');
        });

        /*** Log In ***/

        function LogIn()
        {
            // Default Variables
            var AuthButton = '.Sign-In-UI>form input[type=submit]',
                AuthForm = '.Sign-In-UI>form',
                LogPath = '/login';

            // Update body
            $(document).on('click', AuthButton, function ()
            {
                // Function Variables
                var This = this;

                // Send Ajax to "/alias/update"
                $.ajax({
                    type:     'post',
                    url:      LogPath,
                    data:     $(AuthForm).serialize(),
                    dataType: 'json',
                    success:  function (Data)
                    {
                        if (Data['type'] == 'Success')
                        {
                            location.href = '/cabinet/';
                        } else
                        {
                            upf.Messages.Show(Data['message'], Data['type']);
                        }
                    }
                });

                return false;
            });
        }

        LogIn();


        /*** Log In ***/

        function Register()
        {
            // Default Variables
            var AuthButton = '.Sign-Up-UI>form input[type=submit]',
                AuthForm = '.Sign-Up-UI>form',
                LogPath = '/register';

            // Update body
            $(document).on('click', AuthButton, function ()
            {
                // Function Variables
                var This = this;
                var EmailRegular = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

                // Send Ajax to "/alias/update"
                if (EmailRegular.test($(AuthForm).find("input[name=login]").val()))
                {
                    $.ajax({
                        type:     'post',
                        url:      LogPath,
                        data:     $(AuthForm).serialize(),
                        dataType: 'json',
                        success:  function (Data)
                        {
                            if (Data['type'] == 'Success')
                            {
                                location.href = '/cabinet/profile/';
                            } else
                            {
                                upf.Messages.Show(Data['message'], Data['type']);
                            }
                        }
                    });
                } else
                {
                    upf.Messages.Show('Неверный Email', 'Error');
                }
                return false;
            });

        }

        Register();




        $(window).scroll(function ()
        {
            /*** Paralax Top Menu ***/
            if ($(window).scrollTop() >= 0 && $(window).scrollTop() < 350)
            {
                scrollPos = $(this).scrollTop();
                /*** Parallax общий ***/
                $('#Page-Slider').css({
                    'height': 250 - (scrollPos * 2) + "px"
                });
                /*** Paralax кнопок ***/
                $('#Slider-Links').css({
                    'left': 400 + (scrollPos) + "px",
                    'opacity': 1 - (scrollPos / 200)
                });
                /*** Paralax БелАЗа ***/
                $('#Truck').css({
                    'top': (scrollPos * 1.2) + "px",
                    'opacity': 1 - (scrollPos / 100)
                });
                /*** Paralax фона ***/
                $('#Page-Slider').css({
                    'background-position': 'center ' + (-scrollPos / 18) + "px"
                });
            }
            /*** Появление Кнопка Вверх ***/
            if (($(this).scrollTop() > 0) && ($(window).width() > 500))
            {
                $('#Scroll-Top').fadeIn();
            } else
            {
                $('#Scroll-Top').fadeOut();
            }
        });








        /*** Скролл вверх ***/
        $('#Scroll-Top').click(function ()
        {
            $('body,html').animate({
                scrollTop: 0
            }, 400);
            return false;
        });

        /*** Мобильное меню ***/
        $('#Menu-Toggle').click(function ()
        {
            if ($('#Menu').is(':hidden'))
            {
                $('#Menu').slideDown('slow');
            } else
            {
                $('#Menu').slideUp('slow');
            }
        });

        /*** window resize ***/
        $(window).resize(function ()
        {
            if ($(window).width() > 1024)
            {
                $('#Menu').show();
            }
        });

    });
})(jQuery);