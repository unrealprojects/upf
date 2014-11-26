(function ($)
{








////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Dropdown Settings
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    var Dropdown = {
        // Selectors
        Element:   '.Dropdown',
        Content:   '.Dropdown-Content',
        Title:     '.Dropdown-Title',
        Toggle:    '.Dropdown-Toggle',
        // Switches
        Collapsed: 'Collapsed',
        Expanded:  'Expanded',
        // Extended
        Duration:  160
    };

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////










////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// InputSelect Settings
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    var InputSelect = {
        // Selectors
        Element:                    '.Input-Select  ',
        Content:                    '.Input-Select-Content',
        Item:                       'li',
        Clean:                      '.Input-Select-Clean',
        Toggle:                     '.Input-Select-Toggle',
        Input_Value:                'input[type=text]',
        Input_Index:                'input[type=hidden]',
        // Switches
        Collapsed:                  'Collapsed',
        Expanded:                   'Expanded',
        Item_Same:                  'Same',
        Item_Hidden:                'Hidden',
        Item_Visible:               'Visible',
        // MultiSelect :: Selectors
        Checkbox:                   'input[type=checkbox]',
        // Data-Types
        Data_Same_Items:            'data-same-items',             // Available values: true, false
        Data_Same_Items__Default:   'false',
        // MultiSelect :: Data-Types
        Data_Index:                 'data-index',
        Data_Selected_Index:        'data-selected-index',
        Data_Multi_Select:          'data-multi-select',           // Available values: checkbox, tag, column ,drag-column
        Data_Multi_Select__Default: 'checkbox',
        // Extended
        Duration:                   120
    };

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////










////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Script Settings
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    var Script = {
        Element: '.Script'
    };

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////










////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Execute
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   // Forms__Dropdown();
    Forms__InputSelect();
   // Forms__Script();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////










////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Dropdown
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function Forms__Dropdown()
    {

        // Presets
        $(Dropdown.Element).addClass(Dropdown.Collapsed);
        var Toggle = false;

        // Body
        $(document).on('click', Dropdown.Title, function ()
        {
            $(Dropdown.Element + '.' + Dropdown.Expanded).not($(this).parent()).find(Dropdown.Content).slideUp(Dropdown.Duration);
            $(Dropdown.Element + '.' + Dropdown.Expanded).not($(this).parent()).find(Dropdown.Toggle).animate({transform: 'rotate(0deg)'}, Dropdown.Duration);
            $(Dropdown.Element + '.' + Dropdown.Expanded).not($(this).parent()).removeClass(Dropdown.Expanded).addClass(Dropdown.Collapsed);

            $(this).parents(Dropdown.Element).find(Dropdown.Content).slideToggle(Dropdown.Duration);
            $(this).parents(Dropdown.Element).toggleClass(Dropdown.Collapsed + ' ' + Dropdown.Expanded);

            // Toggle Button
            if (!Toggle)
            {
                $(this).parents(Dropdown.Element).find(Dropdown.Toggle).animate({transform: 'rotate(-180deg)'}, Dropdown.Duration);
                Toggle = true;
            } else
            {
                $(this).parents(Dropdown.Element).find(Dropdown.Toggle).animate({transform: 'rotate(0deg)'}, Dropdown.Duration);
                Toggle = false;
            }

            return false;
        });

        // Focus Out
        $(document).on('click', 'body', function ()
        {
            $(Dropdown.Element + '.' + Dropdown.Expanded).find(Dropdown.Content).slideUp(Dropdown.Duration);
            $(Dropdown.Element + '.' + Dropdown.Expanded).find(Dropdown.Toggle).animate({transform: 'rotate(0deg)'}, Dropdown.Duration);
            $(Dropdown.Element + '.' + Dropdown.Expanded).removeClass(Dropdown.Expanded).addClass(Dropdown.Collapsed);
        });
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////










////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Input Select
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // Todo :: Same Items (In List And Under the Line)
    // Todo :: MultiSelect Div
    // Todo :: Sort ( Value (ASC,DESC) ,Index (ASC,DESC), Length (ASC,DESC) )


    function Forms__InputSelect()
    {
        // Todo::Show-Hide InputSelect.Clean
        // Todo:: data-ajax
        // Todo:: data-multi-select

        function MultiSelect_Type(Selector)
        {
            var Type = $(Selector).attr(InputSelect.Data_Multi_Select);
            if (Type == 'checkbox' || Type == 'tag' || Type == 'column' || Type == 'drag-column')
            {
                return Type;
            } else
            {
                Type = false;
                return Type;
            }
        }


        // Show List
        $(document).on('click', InputSelect.Element, function ()
        {

            $(InputSelect.Content, this).slideDown(InputSelect.Duration, function ()
            {
                $(this).parent()
                    .addClass(InputSelect.Expanded)
                    .removeClass(InputSelect.Collapsed);
                $(InputSelect.Toggle, $(this).parent()).animate({transform: 'rotate(180deg)'}, InputSelect.Duration);
            });

            // Hide Other Selects
            $(InputSelect.Content).not($(InputSelect.Content,this)).slideUp(InputSelect.Duration, function ()
            {
                $(this).parent()
                    .addClass(InputSelect.Collapsed)
                    .removeClass(InputSelect.Expanded);
                $(InputSelect.Toggle, $(this).parent()).animate({transform: 'rotate(0deg)'}, InputSelect.Duration);
            });


            return false;
        });

        // Hide List (Body)
        $(document).on('click', 'body', function ()
        {
            $(InputSelect.Content).slideUp(InputSelect.Duration, function ()
            {
                $(this).parent()
                    .addClass(InputSelect.Collapsed)
                    .removeClass(InputSelect.Expanded);
                $(InputSelect.Toggle, $(this).parent()).animate({transform: 'rotate(0deg)'}, InputSelect.Duration);
            });
        });

        // Hide List (Toggle)
        $(document).on('click', InputSelect.Toggle, function ()
        {
            var $BaseElement = $(this).parents(InputSelect.Element);

            if ($BaseElement.hasClass(InputSelect.Expanded))
            {
                $BaseElement.find(InputSelect.Content).slideUp(InputSelect.Duration, function ()
                {
                    $BaseElement
                        .addClass(InputSelect.Collapsed)
                        .removeClass(InputSelect.Expanded);
                });
                $(this).animate({transform: 'rotate(0deg)'}, InputSelect.Duration);

            } else
            {
                $BaseElement.trigger('click');
            }

            return false;
        });

        // Default Selected Value
        $(InputSelect.Element).each(function(ElementKey,Element){
            $(InputSelect.Item, Element).each(function(ItemKey,Item){
                if($(Item).attr('selected'))
                {
                    $(InputSelect.Input_Value, Element).val($(Item).text());
                    $(InputSelect.Input_Index, Element).val($(Item).attr(InputSelect.Data_Index));
                    return false;
                }
            });
        });

        // Add Selected Value
        $(document).on('click', InputSelect.Content + ' ' + InputSelect.Item, function ()
        {
            var $BaseElement = $(this).parents(InputSelect.Element);


            if ($BaseElement.attr(InputSelect.Data_Multi_Select) == 'checkbox')
            {
                //Multi Select Checkbox
                var $Checkbox = $(this).find(InputSelect.Checkbox);
                $Checkbox.prop('checked', !$Checkbox.prop("checked"));
            } else
            {
                // Select
                $BaseElement.attr(InputSelect.Data_Selected_Index, $(this).attr(InputSelect.Data_Index));
                $(InputSelect.Input_Index, $BaseElement).val($(this).attr(InputSelect.Data_Index));
                $(InputSelect.Input_Value, $BaseElement).val($(this).text());
            }
        });

        // Type
        $(document).on('keyup', InputSelect.Element + ' ' + InputSelect.Input_Value, function ()
        {

            var ButtonKey = event.which;

            if (ButtonKey == 32 || (48 <= ButtonKey && ButtonKey <= 57) || (65 <= ButtonKey && ButtonKey <= 90) || (97 <= ButtonKey && ButtonKey <= 122) || ButtonKey == 8)
            {

                var Filters = $(this).val().toLowerCase().split(' ');
                var $Item = $(InputSelect.Content + ' ' + InputSelect.Item, $(this).parent());

                // Set Visible
                if (Filters[0].length > 0)
                {
                    $Item.removeClass(InputSelect.Item_Visible + ' ' + InputSelect.Item_Hidden + ' ' + InputSelect.Item_Same);

                    $Item.each(function (ItemKey, Item)
                    {

                        // Exact Items
                        $.each(Filters, function (FilterKey, Filter)
                        {
                            if (Filter.length)
                            {
                                if ($(Item).text().toLowerCase().search(Filter) >= 0 && !$(Item).hasClass(InputSelect.Item_Hidden))
                                {
                                    $(Item).addClass(InputSelect.Item_Visible);
                                } else
                                {
                                    $(Item).addClass(InputSelect.Item_Hidden)
                                        .removeClass(InputSelect.Item_Visible);
                                }
                            }
                        });

                        // Same Items
                        $.each(Filters, function (FilterKey, Filter)
                        {
                            if (Filter.length > 2)
                            {
                                var Same = '',
                                    CircleSame = false;
                                for (var I = 0; I <= Filter.length; I++)
                                {

                                    if (I < Filter.length)
                                    {
                                        Same = new RegExp(Filter.substr(0, I) + '[^]' + Filter.substr(I + 1, Filter.length));
                                    } else
                                    {
                                        Same = Filter;
                                    }

                                    if ($(Item).text().toLowerCase().search(Same) >= 0)
                                    {
                                        if (FilterKey == 0 && $(Item).hasClass(InputSelect.Item_Hidden))
                                        {
                                            $(Item).addClass(InputSelect.Item_Same)
                                                .removeClass(InputSelect.Item_Hidden);
                                        }
                                        else if ($(Item).text().toLowerCase().search(Same) >= 0 && FilterKey > 0 && $(Item).hasClass(InputSelect.Item_Same))
                                        {
                                            CircleSame = true;
                                            $(Item).addClass(InputSelect.Item_Same)
                                                .removeClass(InputSelect.Item_Hidden);
                                        }
                                    }

                                }


                                // More Than One Coincidence
                                if (CircleSame == false && FilterKey > 0)
                                {
                                    $(Item).removeClass(InputSelect.Item_Same).addClass(InputSelect.Item_Hidden);
                                }

                            }
                        });


                    });


                    // Show Visible

                    $(InputSelect.Content + ' .' + InputSelect.Item_Hidden).slideUp();
                    $(InputSelect.Content + ' .' + InputSelect.Item_Visible + ',' + InputSelect.Content + ' .' + InputSelect.Item_Same).slideDown();

                } else
                {
                    // Todo::Make a Function
                    $Item.removeClass(InputSelect.Item_Hidden)
                        .addClass(InputSelect.Item_Visible)
                        .slideDown();
                }
            }
        });


        // Clean
        $(document).on('click', InputSelect.Element + ' ' + InputSelect.Clean, function ()
        {
            $(InputSelect.Input_Index, $(this).parent()).val(' ');
            $(InputSelect.Input_Value, $(this).parent()).val(' ');

            // Todo::Make a Function
            $(InputSelect.Content + ' ' + InputSelect.Item, $(this).parent()).removeClass(InputSelect.Item_Hidden)
                .addClass(InputSelect.Item_Visible)
                .slideDown();
        });
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////










////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Script
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function Forms__Script()
    {
        $(document).on('click', Script.Element, function ()
        {
            return false;
        });
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////









})(jQuery);
