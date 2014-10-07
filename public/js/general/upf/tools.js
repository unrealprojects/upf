/*********************************************************************************************************************** Dropdown ***/
upf.Tools.Dropdown = function(){
    // Default Variables
    var Dropdown            =   '.Dropdown',
        DropdownContent     =   '.Dropdown-Content',
        DropdownTitle       =   '.Dropdown-Title',
        DropdownToggle      =   '.Dropdown-Toggle',
        Collapsed           =   'Collapsed',
        Expanded            =   'Expanded',
        Flip                =   'Flip';

    // Presets
    $(Dropdown).addClass('Collapsed');
    var Toggle = false;

    // Body
    $(document).on('click',DropdownTitle,function(){
        $(this).parents(Dropdown).find(DropdownContent).slideToggle();
        $(this).parents(Dropdown).toggleClass(Collapsed+' '+Expanded);
        $(this).parents(Dropdown).find(DropdownToggle).toggleClass(Flip);

        // Toggle Button
        if(!Toggle){
            $(this).parents(Dropdown).find(DropdownToggle).animate({transform: 'rotate(-180deg)'});
            Toggle = true;
        }else{
            $(this).parents(Dropdown).find(DropdownToggle).animate({transform: 'rotate(0deg)'});
            Toggle = false;
        }

        return false;
    });
}

/*********************************************************************************************************************** Execute Functions ***/
upf.Tools.Dropdown();
