/*********************************************************************************************************************** Dropdown ***/
upf.Tools.Dropdown = function(){
    // Default Variables
    var Dropdown            =   '.Dropdown',
        DropdownContent     =   '.Dropdown-Content',
        DropdownToggle      =   '.Dropdown-Toggle';


    // Default Hidden
    $(DropdownContent).hide();

    // Body
    $(document).on('click',DropdownToggle,function(){
        $(this).parents(Dropdown).find(DropdownContent).slideToggle();
        return false;
    });
}

/*********************************************************************************************************************** Execute Functions ***/
upf.Tools.Dropdown();