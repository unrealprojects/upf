/*********************************************************************************************************************** Dropdown ***/
upf.Tools.Dropdown = function(){
    // Default Variables
    var Dropdown            =   '.Dropdown',
        DropdownContent     =   '.Dropdown-Content',
        DropdownTitle       =   '.Dropdown-Title',
        DropdownToggle      =   '.Dropdown-Toggle',
        Collapsed           =   'Collapsed',
        Expanded            =   'Expanded',
        Duration            =   500;

    // Presets
    $(Dropdown).addClass('Collapsed');
    var Toggle = false;

    // Body
    $(document).on('click',DropdownTitle,function(){
        $(Dropdown+'.'+Expanded).not($(this).parent()).find(DropdownContent).slideUp(Duration);
        $(Dropdown+'.'+Expanded).not($(this).parent()).find(DropdownToggle).animate({transform: 'rotate(0deg)'},Duration);
        $(Dropdown+'.'+Expanded).not($(this).parent()).removeClass(Expanded).addClass(Collapsed);

        $(this).parents(Dropdown).find(DropdownContent).slideToggle(Duration);
        $(this).parents(Dropdown).toggleClass(Collapsed+' '+Expanded);

        // Toggle Button
        if(!Toggle){
            $(this).parents(Dropdown).find(DropdownToggle).animate({transform: 'rotate(-180deg)'},Duration);
            Toggle = true;
        }else{
            $(this).parents(Dropdown).find(DropdownToggle).animate({transform: 'rotate(0deg)'},Duration);
            Toggle = false;
        }

        return false;
    });

    // Focus Out
    $(document).on('click','body',function(){
        $(Dropdown+'.'+Expanded).find(DropdownContent).slideUp(Duration);
        $(Dropdown+'.'+Expanded).find(DropdownToggle).animate({transform: 'rotate(0deg)'},Duration);
        $(Dropdown+'.'+Expanded).removeClass(Expanded).addClass(Collapsed);
    });
}

/*********************************************************************************************************************** Execute Functions ***/
upf.Tools.Dropdown();
