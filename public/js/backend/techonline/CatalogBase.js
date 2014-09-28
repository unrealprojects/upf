$(document).ready(function(){
    $(".create_model").click(function(){
        if(($(".create_model").text())=="Введите название модели"){
            $(this).text(" ");
        }

        if(($(".create_description").text())==" "){
              $(".create_description").text("Введите описание модели");
        }
    });

    $(".create_description").click(function(){
        if(($(".create_description").text())=="Введите описание модели"){
            $(this).text(" ");
        }

        if(($(".create_model").text())==" "){
            $(".create_model").text("Введите название модели");
        }
    });



    $('.create').click(function(){

        var item_model=$('h4',$(this).parent()).text();
        var item_description=$('p',$(this).parent()).text();

        $.ajax({
            url:"/backend/catalog/create/",
            data:"model="+item_model+"&description="+item_description,
            type: "GET",
            success: function(){
                $(".massage").text('Запись успешно добавлена ');
            }

        });
    });




    $('.delete').click(function(){
        this_elem=this;
        var item_id=$(this).parent().attr('id');
        item_id=item_id.substring(2);
        $.ajax({
            url:"/backend/catalog/delete/"+item_id,
            type: "GET",
            success: function(){
                $(this_elem).parent().remove();
                $(".massage").text('Запись успешно удалена ');
            }

        });
    });



    $('.update').click(function(){
        var item_id=$(this).parent().attr('id');
        item_id=item_id.substring(2);
        var item_model=$('h4',$(this).parent()).text();
        var item_description=$('p',$(this).parent()).text();

        $.ajax({
            url:"/backend/catalog/update/"+item_id,
            data:"model="+item_model+"&description="+item_description,
            type: "GET",
            success: function(){
                $(".massage").text('Запись успешно обновлена ');
            }

        });
    });
});