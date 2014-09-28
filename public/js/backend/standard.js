/*** Menu :: Accordion ***/
upf.Menu.Accordion = function(){
    // Default Variables
    var Active = '.Active',
        Items = '.Menu-Category-Link',
        SubItems = '.Menu-Subcategory-Item';     // .Menu-Subcategory-Item OR .Menu-Subcategory

    // Active as default is open
    $(SubItems).hide();
    $(SubItems,$(Active).parent()).show();

    // Accordion's Body
    $(document).on('click',Items,function(){
        var CurrentSubItems = $(SubItems,$(this).parent());
        var Current = $(this);

        if(!CurrentSubItems.is(':visible')){
            // Click to Closed Tab
            $(SubItems+':visible').slideUp();
            CurrentSubItems.slideDown();

            $(Items).removeClass('Active');
            Current.addClass('Active');
        }else{
            // Click to Opened Tab
            CurrentSubItems.slideToggle();
            Current.toggleClass('Active');
        }
        return false;
    });
}

/*** Menu :: Toggle Menu ***/
upf.Menu.ToggleMenu = function(){
    // Default Variables
    var $Menu = $('.Menu,.Menu-Shadow'),
        $SiteContent = $('main'),
        NavMenu = '#Nav-Menu',
        PullWidth = '0px',
        PushWidth = '300px';

    // Toggle Menu's body
    $(document).on('click',NavMenu,function(){
        if($Menu.css('left')!=PullWidth){
            // Click to Show menu
            $SiteContent.animate({'margin-left':PushWidth});
            $Menu.animate({'left':PullWidth,'opacity':1});
        }else{
            // Click to Hide menu
            $SiteContent.animate({'margin-left':PullWidth});
            $Menu.animate({'left':'-'+PushWidth,'opacity':0});
        }
        return false;
    });
}

/*** List :: Check All ***/
upf.List.CheckAll = function(){
    // Default Variables
    var Toggle = '#Select-All';
    var CheckedItems = '.Selected-Items[type=checkbox]';

    // Click to Toggle and Check Items
    $(document).on('click',Toggle,function(){
        if($(Toggle).is(':checked')){
            $(CheckedItems).prop('checked',true);
        }else{
            $(CheckedItems).prop('checked',false);
        }
    });

    // UnCheck Items
    $(document).on('click',CheckedItems,function(){
        if($(CheckedItems).length == $(CheckedItems+':checked').length){
            $(Toggle).prop('checked',true);
        }else{
            $(Toggle).prop('checked',false);
        }
    });
}

/*** List :: Update Item ***/
upf.List.UpdateItem = function(){
    // Default Variables
    var UpdateButton = '.Item-Update';

    // Update body
    $(document).on('click',UpdateButton,function(){
        // Function Variables
        var Current = this,
            $FieldsToUpdate = $(Current).parents('tr').find('[contenteditable=true]'),
            $ItemAlias = $(Current).parents('tr').attr('item-alias'),
            DataToUpdate = {};

        // Get Data To Update
        $FieldsToUpdate.each(function(key,item){
            DataToUpdate[$(item).attr('item-field')]=$(item).text();
        });

        // Send Ajax to "/alias/update"
        $.ajax({
            type:'post',
            url:location.pathname + '/' + $ItemAlias + '/update',
            data: DataToUpdate,
            dataType:'json',
            success: function(){

            }
        });
        return false;
    });
}

/*** List :: Remove Item ***/
upf.List.RemoveItem = function(){
    // Default Variables
    var RemoveButton = '.Item-Remove';

    // Update body
    $(document).on('click',RemoveButton,function(){
        // Function Variables
        var Current = this,
            $ItemAlias = $(Current).parents('tr').attr('item-alias');

        // Send Ajax to "/alias/remove"
        $.ajax({
            type:'get',
            url:location.pathname + '/' + $ItemAlias + '/remove',
            dataType:'json',
            success: function(){

            }
        });
        return false;
    });
}

/*** Call Function ***/
$(document).ready(function(){
    /*** Menu ***/
    upf.Menu.Accordion();
    upf.Menu.ToggleMenu();

    /*** List ***/
    upf.List.CheckAll();
    upf.List.UpdateItem();
    upf.List.RemoveItem();
});