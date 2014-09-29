    window.upf = {};

/*** Backend ***/
window.upf.Menu = {};
window.upf.List = {};
window.upf.Edit = {};
window.upf.Add = {};

/*** Box ***/
window.upf.Box = {};
/*** Messages ***/
window.upf.Messages = {};

/*** Box :: Delete ***/
upf.Box.Delete = function(){
    // Default Variables
    var DeleteButton = '.Box-Delete',
        Box = '.Box';

    $(document).on('click',DeleteButton,function(){
        $(this).parents(Box).animate({'width':'0px','height':'0px','opacity':'0','margin':'0px'},function(){
            $(this).remove();
        });
        return false;
    });
}
/*** Box :: Hide ***/
upf.Box.Hide = function(){
    // Default Variables
    var HideButton = '.Box-Hide',
        Box = '.Box';
    //
    $(document).on('click',HideButton,function(){
        $(this).parents(Box).animate({'width':'0px','height':'0px','opacity':'0','margin':'0px'});
        return false;
    });
}
/*** Box :: Drop-Down ***/
upf.Box.DropDown = function(){
    // Default Variables
    var DropDownButton = '.Box-Drop-Down',
        Box = '.Box',
        BoxContent = '.Box-Content';

    $(document).on('click',DropDownButton,function(){
        $(this).parents(Box).find(BoxContent).slideToggle();
        return false;
    });
}

/*** Messages :: Show ***/
upf.Messages.Show = function (message,type){
    if(type===undefined){
        type='success';
    }
    var title = {
        'success':'Успешно!',
        'error':'Успешно!'
    };
    // Default Variables
    var Message = '.Message';

    // Remove Old Message
    $(Message).remove();

    // Show New Message
    $('body').append('<aside class="Message Bottom-Right Icon '+type+'">'+
        '<h4>'+title[type]+'</h4>'+
        '<p>'+message+'</p>'+
        '</aside>');
    $(Message).effect('bounce').delay(2000).fadeOut(2000);
}

/*** Box ***/
upf.Box.Delete();
upf.Box.Hide();
upf.Box.DropDown();

