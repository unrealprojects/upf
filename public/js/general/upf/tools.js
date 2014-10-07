/*********************************************************************************************************************** Dropdown ***/
upf.Tools.Dropdown = function(){
    // Default Variables
    var Dropdown            =   '.Dropdown',
        DropdownContent     =   '.Dropdown-Content',
        DropdownTitle       =   '.Dropdown-Title',
        DropdownToggle      =   '.Dropdown-Toggle',
        Collapsed           =   'Collapsed',
        Extended            =   'Extended',
        Flip                =   'Flip';

    // Presets
    $(Dropdown).addClass('Collapsed');

    // Body
    $(document).on('click',DropdownTitle,function(){
        $(this).parents(Dropdown).find(DropdownContent).slideToggle();
        $(this).parents(Dropdown).toggleClass(Collapsed+' '+Extended);
        $(this).parents(Dropdown).find(DropdownToggle).toggleClass(Flip);

        return false;
    });
}

/*********************************************************************************************************************** Execute Functions ***/
upf.Tools.Dropdown();
