/*********************************************************************************************************************** Menu ***/

/*** Accordion ***/
upf.Menu.Accordion = function ()
{
    // Default Variables
    var Active = '.Active',
        Items = '.Menu-Category-Link',
        SubItems = '.Menu-Subcategory-Item';     // .Menu-Subcategory-Item OR .Menu-Subcategory

    // Active as default is open
    $(SubItems).hide();
    $(SubItems, $(Active).parent()).show();

    // Accordion's Body
    $(document).on('click', Items, function ()
    {
        var CurrentSubItems = $(SubItems, $(this).parent());
        var Current = $(this);

        if (!CurrentSubItems.is(':visible'))
        {
            // Click to Closed Tab
            $(SubItems + ':visible').slideUp();
            CurrentSubItems.slideDown();

            $(Items).removeClass('Active');
            Current.addClass('Active');
        } else
        {
            // Click to Opened Tab
            CurrentSubItems.slideToggle();
            Current.toggleClass('Active');
        }
        return false;
    });
}

/*** Toggle Menu ***/
upf.Menu.ToggleMenu = function ()
{
    // Default Variables
    var $Menu = $('.Menu,.Menu-Shadow'),
        $SiteContent = $('main'),
        NavMenu = '#Nav-Menu',
        PullWidth = '0px',
        PushWidth = '300px';

    // Toggle Menu's body
    $(document).on('click', NavMenu, function ()
    {
        if ($Menu.css('left') != PullWidth)
        {
            // Click to Show menu
            $SiteContent.animate({'margin-left': PushWidth});
            $Menu.animate({'left': PullWidth, 'opacity': 1});
        } else
        {
            // Click to Hide menu
            $SiteContent.animate({'margin-left': PullWidth});
            $Menu.animate({'left': '-' + PushWidth, 'opacity': 0});
        }
        return false;
    });
}

/*** Active Item ***/
upf.Menu.ActiveItem = function ()
{
    // Default Variables
    var Active = 'Active',
        Link = location.pathname;

    $('a').removeClass(Active);
    $('a[href="' + Link + '"]').addClass(Active);
    $('a[href="' + Link + '"]').parents('.Menu-Category-Item').find('.Menu-Category-Link').addClass(Active);
}


/*********************************************************************************************************************** List ***/

/*** Check All ***/
upf.List.CheckAll = function ()
{
    // Default Variables
    var Toggle = '#Select-All';
    var CheckedItems = '.Selected-Items[type=checkbox]';

    // Click to Toggle and Check Items
    $(document).on('click', Toggle, function ()
    {
        if ($(Toggle).is(':checked'))
        {
            $(CheckedItems).prop('checked', true);
        } else
        {
            $(CheckedItems).prop('checked', false);
        }
    });

    // UnCheck Items
    $(document).on('click', CheckedItems, function ()
    {
        if ($(CheckedItems).length == $(CheckedItems + ':checked').length)
        {
            $(Toggle).prop('checked', true);
        } else
        {
            $(Toggle).prop('checked', false);
        }
    });
}










/*********************************************************************************************************************** Call Function ***/
$(document).ready(function ()
{
    /*** Menu ***/
    upf.Menu.ActiveItem();
    upf.Menu.Accordion();
    upf.Menu.ToggleMenu();


    /*** List ***/
    upf.List.CheckAll();
});


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Editor
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if($('#field_text').length){
    var CK_Field_Text = CKEDITOR.inline('field_text');
}
if($('#field_intro').length){
    var CK_Field_Intro = CKEDITOR.inline('field_intro');
}
if($('#field_about').length){
    var CK_Field_About = CKEDITOR.inline('field_about');
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Meta
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

var $Title = $('[name=meta-title]');
$Title.after('<p class="Check-Symbols-Title Node-XXS-9 Push-3">' + $Title.val().length + '</p>');
if( $Title.val().length > 52 ){
    $('.Check-Symbols-Title').addClass('Error');
}

$Title.keyup(function(){
    $('.Check-Symbols-Title').remove();
    $Title.after('<p class="Check-Symbols-Title Node-XXS-9 Push-3">' + $Title.val().length + '</p>');
    if( $Title.val().length > 52 ){
        $('.Check-Symbols-Title').addClass('Error');
    }
});


var $Description = $('[name=meta-description]');
$Description.after('<p class="Check-Symbols-Description Node-XXS-9 Push-3">' + $Description.val().length + '</p>');
if( $Description.val().length > 156){
    $('.Check-Symbols-Description').addClass('Error');
}

$Description.keyup(function(){
    $('.Check-Symbols-Description').remove();
    $Description.after('<p class="Check-Symbols-Description Node-XXS-9 Push-3">' + $Description.val().length + '</p>');
    if( $Description.val().length > 156){
        $('.Check-Symbols-Description').addClass('Error');
    }
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////