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

        // Send Ajax to "/alias/update"
        var formData = new FormData($(UpdateForm)[0]);
        $.ajax({
            type:'POST',
            url:  location.pathname.replace('edit','') + 'update',
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
        data = new FormData($(UpdateForm));
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
                            $('#field_logotype').after('<img class="Uploaded" src="'+Data['files']['logotype']+'"/>');
                        }
                    }
                    if(Data['files']['photos']){
                        $.each(Data['files']['photos'],function(key,value){
                            $('#field_meta-files').after('<img src="'+value+'">');
                        });
                    }
                }
            },
            cache: false,
            contentType: false,
            processData: false
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
        var Current = this,
            $FieldsToUpdate = $(Current).parents('tr').find('[contenteditable=true]');

        // Send Ajax to "/alias/update"
        $.ajax({
            type:'POST',
            url:  location.pathname,
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

/*********************************************************************************************************************** Call Function ***/

$(document).ready(function(){
    /*** List ***/
    upf.List.UpdateItem();
    upf.List.TrashItem();

    /*** Edit ***/
    upf.Edit.UpdateItem();
    upf.Edit.UpdateItemFiles();

    /*** Add ***/
    upf.Add.NewItem();
});