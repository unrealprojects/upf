/*********************************************************************************************************************** List ***/

/*** *** Update Item *** ***/

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
            success: function(Data){
                upf.Messages.Show(Data['message'],Data['type']);
            }
        });
        return false;
    });
}

/*** *** Trash Item *** ***/

upf.List.TrashItem = function(){
    // Default Variables
    var TrashButton = '.Item-Remove';

    // Update body
    $(document).on('click',TrashButton,function(){
        // Function Variables
        var This = this,
            $ItemAlias = $(This).parents('tr').attr('item-alias');

        // Send Ajax to "/alias/trash"
        $.ajax({
            type:'get',
            url:location.pathname + '/' + $ItemAlias + '/remove',
            dataType:'json',
            success: function(Data){
                if(Data['type']=='Success'){
                    $(This).parents('tr').animate({'opacity':0},function(){
                        $(this).remove();
                    });
                }
                upf.Messages.Show(Data['message'],Data['type']);
            }
        });
        return false;
    });
}


/*********************************************************************************************************************** Edit ***/

/*** *** Update Item *** ***/
upf.Edit.UpdateItem = function(){
    // Default Variables
    var UpdateButton = '#Edit-Item input[type=submit]',
        UpdateForm = 'form#Edit-Item';

    // Update body
    $(document).on('click',UpdateButton,function(){
        // Function Variables
        var Current = this;

        // Send Ajax to "/alias/update" or /update
        var path = location.pathname.replace('/edit','') + '/update';

        var formData = new FormData($(UpdateForm)[0]);
        $.ajax({
            type:'POST',
            url: path ,
            data: $(UpdateForm).serialize(),
            dataType:'json',
            success: function(Data){
                upf.Messages.Show(Data['message'],Data['type']);
                if(Data['file']){
                    $('.Control-Group img').attr('src',Data['file']);
                }
            }
        });
        return false;
    });
}

/*** *** Update Item Files *** ***/

upf.Edit.UpdateItemFiles = function(){
    // Default Variables
    var UpdateButton = '#Edit-Item input[type=file]',
        UpdateForm = 'form#Edit-Item';

    // Update body
    $(document).on('change',UpdateButton,function(){
        // Send Ajax to "/alias/update"
        var This = this;
        var formData = new FormData($(UpdateForm)[0]);
        $.ajax({
            type:'POST',
            url:  location.pathname.replace('edit','') + 'updatePhotos',
            data: formData,
            dataType:'json',
            success: function(Data){
                upf.Messages.Show(Data['message'],Data['type']);
                if(Data['files']){
                    if(Data['files']['logotype']){
                        if($('.Field-Img-logotype').length){
                            $('.Field-Img-logotype').attr('src',Data['files']['logotype']);
                        }else{
                            $('.Control-Photo .Upload').append(
                                '<ul class="Grid Split"><li class="Node-XS-3"><a href="#" class="Link-Delete">Удалить</a><img class="Uploaded" src="'+Data['files']['logotype']+'"/></li></ul>');
                        }
                    }
                    if(Data['files']['photos']){
                        $.each(Data['files']['photos'],function(key,value){
                            $('.Control-Photos .Upload .Grid').append('<li  class="Node-XS-3"><a href="#" class="Link-Delete">Удалить</a><img src="'+value['src']+'" item_img_id="'+value['id']+'"></li>');
                        });
                    }

                    $(This).replaceWith($(This).clone(true));
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    });
}

/*** *** Remove Item Logotype *** ***/

upf.Edit.RemoveItemLogotype = function(){
    // Default Variables
    var RemoveButton = '.Control-Photo .Link-Delete';

    // Update body
    $(document).on('click',RemoveButton,function(){
        var This = this;
        $.ajax({
            type:'POST',
            url:  location.pathname.replace('edit','') + 'removeLogotype',
            dataType:'json',
            success: function(Data){
                upf.Messages.Show(Data['message'],Data['type']);
                $(This).parent().remove();
            }
        });
        return false;
    });
}

/*** *** Remove Item Photos *** ***/

upf.Edit.RemoveItemPhotos = function(){
    // Default Variables
    var RemoveButton = '.Control-Photos .Link-Delete';

    // Update body
    $(document).on('click',RemoveButton,function(){
        var This = this;
        var PhotoId = $(This).next('img').attr('item_img_id');
        $.ajax({
            type:'POST',
            url:  location.pathname.replace('edit','') + 'removePhotos/' + PhotoId,
            dataType:'json',
            success: function(Data){
                upf.Messages.Show(Data['message'],Data['type']);
                $(This).parent().remove();
            }
        });
        return false;
    });
}

/*********************************************************************************************************************** Add ***/

/*** *** New Item *** ***/
upf.Add.NewItem = function(){
    // Default Variables
    var AddButton = '#Add-Item input[type=submit]',
        AddForm = 'form#Add-Item';

    // Update body
    $(document).on('click',AddButton,function(){
        // Function Variables
        var formData = new FormData($(AddForm)[0]);
        // Send Ajax to "/alias/update"
        $.ajax({
            type:'POST',
            url:  location.pathname,
            data: formData,
            dataType:'json',
            success: function(Data){
                upf.Messages.Show(Data['message'],Data['type']);
                if(Data['type']=='Success'){
                    location.href = Data['location'];
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
        return false;
    });
}

/*********************************************************************************************************************** Call Function ***/

$(document).ready(function(){
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