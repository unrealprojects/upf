$Alias = $('input[name=meta-alias]').val();

var AjaxInProcess = false;


/*********************************************************************************************************************** List ***/

/*** *** Update Item *** ***/

upf.List.UpdateItem = function ()
{
    // Default Variables
    var UpdateButton = '.Item-Update';

    // Update body
    $(document).on('click', UpdateButton, function ()
    {
        // Function Variables
        var Current = this,
            $FieldsToUpdate = $(Current).parents('tr').find('[contenteditable=true]'),
            $ItemAlias = $(Current).parents('tr').attr('item-alias'),
            DataToUpdate = {};

        // Get Data To Update
        $FieldsToUpdate.each(function (key, item)
        {
            DataToUpdate[$(item).attr('item-field')] = $(item).text();
        });



        // Send Ajax to "/alias/update"
        $.ajax({
            type:     'post',
            url: location.pathname + '/' + $ItemAlias + '/update',
            data:     DataToUpdate,
            dataType: 'json',
            success:  function (Data)
            {
                upf.Messages.Show(Data['message'], Data['type']);
            }
        });
        return false;
    });
}

/*** *** Trash Item *** ***/

upf.List.TrashItem = function ()
{
    // Default Variables
    var TrashButton = '.Item-Remove';

    // Update body
    $(document).on('click', TrashButton, function ()
    {
        // Function Variables
        var This = this,
            $ItemAlias = $(This).parents('tr').attr('item-alias');
        var URL = '';
        if ($(this).attr('data-remove-link'))
        {
            URL = $(this).attr('data-remove-link');
        } else
        {
            URL = location.pathname + '/' + $ItemAlias + '/remove';
        }

        // Send Ajax to "/alias/trash"
        if (!AjaxInProcess)
        {
            AjaxInProcess = true;
            $.ajax({
                type:     'get',
                url:      URL,
                dataType: 'json',
                success:  function (Data)
                {
                    if (Data['type'] == 'Success')
                    {
                        $(This).parents('tr').animate({'opacity': 0}, function ()
                        {
                            $(this).remove();
                        });
                        // To Cabinet
                        $(This).parents('.Snippet-Item').animate({'opacity': 0}, function ()
                        {
                            $(this).remove();
                        });
                    }
                    upf.Messages.Show(Data['message'], Data['type']);
                    AjaxInProcess = false;
                }
            });
        }
        return false;
    });
}


/*********************************************************************************************************************** Edit ***/

/*** *** Update Item *** ***/

upf.Edit.UpdateItem = function ()
{
    // Default Variables
    var UpdateButton = '#Edit-Item input[type=submit]',
        UpdateForm = 'form#Edit-Item';

    // Update body
    $(document).on('click', UpdateButton, function ()
    {
        // Function Variables
        var Current = this;



        // Send Ajax to "/alias/update" or /update
        var path = location.pathname.replace('/edit', '') + '/update';


        var $__Section = $('input[name=section]');

        if($__Section.length && $__Section.val().length == 0){
            $__Section.remove();
        }


        // Костыль

        if ($('#field_text').length)
        {
            $('#field_text').text(CK_Field_Text.getData());
        }
        if ($('#field_intro').length)
        {
            $('#field_intro').text(CK_Field_Intro.getData());
        }
        if ($('#field_about').length)
        {
            $('#field_about').text(CK_Field_About.getData());
        }

        var formData = new FormData($(UpdateForm)[0]);
        if (!AjaxInProcess)
        {
            AjaxInProcess = true;
            $.ajax({
                type:     'POST',
                url:      path,
                data:     $(UpdateForm).serialize(),
                dataType: 'json',
                success:  function (Data)
                {
                    upf.Messages.Show(Data['message'], Data['type']);
                    if (Data['file'])
                    {
                        $('.Control-Group img').attr('src', Data['file']);
                    }

                    if ($('input[name=meta-alias]').val() != $Alias)
                    {
                        var Path = location.pathname.split('/');
                        Path[4] = $('input[name=meta-alias]').val();
                        Path = Path.join('/');
                        location.href = Path;
                    }
                    AjaxInProcess = false;
                }
            });
        }
        return false;
    });
}





/*** *** Update Item Files *** ***/

upf.Edit.UpdateItemFiles = function ()
{
    // Default Variables
    var UpdateButton = '#Edit-Item input[type=file]',
        UpdateForm = 'form#Edit-Item';

    // Update body
    $(document).on('change', UpdateButton, function ()
    {
        // Send Ajax to "/alias/update"
        var This = this;
        var formData = new FormData($(UpdateForm)[0]);


        if (!AjaxInProcess)
        {
            AjaxInProcess = true;
            $.ajax({
                type:        'POST',
                url: location.pathname.replace('/edit', '') + '/updatePhotos',
                data:        formData,
                dataType:    'json',
                success:     function (Data)
                {
                    upf.Messages.Show(Data['message'], Data['type']);
                    if (Data['files'])
                    {
                        if (Data['files']['logotype'])
                        {
                            if ($('.Field-Img-logotype').length)
                            {
                                $('.Field-Img-logotype').attr('src', Data['files']['logotype']);
                            } else
                            {
                                $('.Control-Photo .Upload').append(
                                    '<ul class="Grid Split"><li class="Node-XS-3"><a href="#" class="Link-Delete">Удалить</a><img class="Uploaded" src="' + Data['files']['logotype'] + '"/></li></ul>');
                            }
                        }
                        if (Data['files']['photos'])
                        {
                            $.each(Data['files']['photos'], function (key, value)
                            {
                                $('.Control-Photos .Upload .Grid').append('<li  class="Node-XS-3"><a href="#" class="Link-Delete">Удалить</a><img src="' + value['src'] + '" item_img_id="' + value['id'] + '"></li>');
                            });
                        }

                        $(This).replaceWith($(This).clone(true));
                    }
                    AjaxInProcess = false;
                },
                cache:       false,
                contentType: false,
                processData: false
            });
        }
        return false;
    });
}

/*** *** Remove Item Logotype *** ***/

upf.Edit.RemoveItemLogotype = function ()
{
    // Default Variables
    var RemoveButton = '.Control-Photo .Link-Delete';

    // Update body
    $(document).on('click', RemoveButton, function ()
    {
        var This = this;
        if (!AjaxInProcess)
        {
            AjaxInProcess = true;
            $.ajax({
                type:     'POST',
                url: location.pathname.replace('/edit', '') + '/removeLogotype',
                dataType: 'json',
                success:  function (Data)
                {
                    upf.Messages.Show(Data['message'], Data['type']);
                    $(This).parent().remove();
                    AjaxInProcess = false;
                }
            });
        }
        return false;
    });
}

/*** *** Remove Item Photos *** ***/

upf.Edit.RemoveItemPhotos = function ()
{
    // Default Variables
    var RemoveButton = '.Control-Photos .Link-Delete';

    // Update body
    $(document).on('click', RemoveButton, function ()
    {
        var This = this;
        var PhotoId = $(This).next('img').attr('item_img_id');
        if (!AjaxInProcess)
        {
            AjaxInProcess = true;
            $.ajax({
                type:     'POST',
                url: location.pathname.replace('/edit', '') + '/removePhotos/' + PhotoId,
                dataType: 'json',
                success:  function (Data)
                {
                    upf.Messages.Show(Data['message'], Data['type']);
                    $(This).parent().remove();
                    AjaxInProcess = false;
                }
            });
        }
        return false;
    });
}

/*********************************************************************************************************************** Add ***/

/*** *** New Item *** ***/
upf.Add.NewItem = function ()
{
    // Default Variables
    var AddButton = '#Add-Item input[type=submit]',
        AddForm = 'form#Add-Item';

    // Update body
    $(document).on('click', AddButton, function ()
    {
        // Function Variables

        // Костыль
        if ($('#field_text').length)
        {
            $('#field_text').val(CK_Field_Text.getData());
        }
        if ($('#field_intro').length)
        {
            $('#field_intro').val(CK_Field_Intro.getData());
        }
        if ($('#field_about').length)
        {
            $('#field_about').val(CK_Field_About.getData());
        }

        var formData = new FormData($(AddForm)[0]);
        // Send Ajax to "/alias/update"


        if (!AjaxInProcess)
        {
            AjaxInProcess = true;
            $.ajax({
                type:        'POST',
                url:         location.pathname,
                data:        formData,
                dataType:    'json',
                success:     function (Data)
                {
                    upf.Messages.Show(Data['message'], Data['type']);
                    if (Data['type'] == 'Success')
                    {
                        location.href = Data['location'];
                    }
                    AjaxInProcess = false;
                },
                cache:       false,
                contentType: false,
                processData: false
            });
        }
        return false;
    });

};


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Search
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('.Search .Go').click(function(){
    var Search = $('input',$(this).parent()).val();
    if(Search.length>0){
        location.href = location.pathname + '?search=' + Search;
    }
});


$('.Search .Clear').click(function(){
    location.href = location.pathname;
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





/*********************************************************************************************************************** Call Function ***/

$(document).ready(function ()
{
    /*** List ***/
    upf.List.UpdateItem();
    upf.List.TrashItem();

    /*** Edit ***/
    upf.Edit.UpdateItem();
    upf.Edit.UpdateItemFiles();
    upf.Edit.RemoveItemLogotype();
    upf.Edit.RemoveItemPhotos();

    /*** Add ***/
    upf.Add.NewItem();
});