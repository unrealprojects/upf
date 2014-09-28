@section('scripts')
@parent
<script>
/*********************************************************************************************************************** SEARCH STRING */
    searchArray = {};
    if(location.search.length>0){
        var search = location.search.replace('?','').split('&');
        $.each(search,function(key,value){
            var item=value.split('=');
            searchArray[item[0]]=item[1];
        });
        delete searchArray['page'];
    }

    if(searchArray['region']){
        addToFilterSelected($('[alias='+searchArray['region']+']'),'Region');
        changeTab('.Tab-Categories',false);
    }

    if(searchArray['category']){
        addToFilterSelected($('[alias='+searchArray['category']+']'),'Category');
        changeTab('.Tab-Params',false);
    }


    /* Проверка Checkbox*/
    var findBrands = false;
    for(var i=0;i<100;i++){
         if(!findBrands && searchArray["brands["+i+"]"]){
             $('input[type=checkbox]').prop('checked',false);
             findBrands=true;
         }
         $('input[name='+searchArray["brands["+i+"]"]).prop('checked',true);
         $('input[name='+searchArray["brands%5B"+i+"%5D"]).prop('checked',true);
    }
    if(findBrands){
        checkedBrands();
    }

    $(document).on('click','.Filter a',function(){return false;});
/*********************************************************************************************************************** HELPER ***/
    /*** Анимация при смене табов ***/
    function scrollToTabs(){
        $('body,html').animate({
            scrollTop: $('.Node.Filter').offset().top
        }, 400);
    }

    /*** Параметры для Категории ***/
    function getAjaxParams($category_alias){
        $.ajax({
            type:'get',
            url:'/filter/'+$category_alias,
            dataType:'json',
            success:function(data){
                $('.Ajax-Params').remove();
                $('.Tab-Params .Form-Vertical>.Control-Group').first().after($('<div/>').html(data['params']).text());
                $('body').append($('<div/>').html(data['script']).text());
            }
        });
    }

    /*** Добавить  в SELECTED ***/
    function addToFilterSelected(element,name){
        if($('.Filter-Result').text().length){
            $("#Filter-Selected-"+name).remove();
            if(name=='Region'){
                $('.Filter-Result').prepend('<li id="Filter-Selected-'+name+'"><span>'+$(element).first().text()+'</span><a class="Delete" alias="'+$(element).attr('alias')+'" href="#">Удалить</a></li>');
            }else{
                $('.Filter-Result').append('<li id="Filter-Selected-'+name+'"><span>'+$(element).first().text()+'</span><a class="Delete" alias="'+$(element).attr('alias')+'" href="#">Удалить</a></li>');
            }
        }else{
            $('.Filter .Heading').after('<ul class="Filter-Result"><li id="Filter-Selected-'+name+'"><span>'+$(element).first().text()+'</span><a class="Delete" alias="'+$(element).attr('alias')+'" href="#">Удалить</a></li></ul>');
        }
    }

    /*** Удаление SELECTED Категорий и Регионов ***/
    $(document).on('click','#Filter-Selected-Region .Delete,' +
                           '#Filter-Selected-Category .Delete',function(){

        $(this).parent().remove();
        if(!$('.Filter-Result').text().length){
            $('.Filter-Result').remove();
        }
        if($(this).parent().is('#Filter-Selected-Region')){
            delete searchArray['region'];
            changeTab('.Tab-Regions');
        }
        if($(this).parent().is('#Filter-Selected-Category')){
            delete searchArray['category'];
            changeTab('.Tab-Categories');
        }
    });

    /*** Функция смены таба ***/
    function changeTab(tabName,scrollToTabs){
        if(scrollToTabs===undefined){scrollToTabs=true;}
        $('.Tabs dt,.Tabs dd').removeClass('Active');
        $(tabName).addClass('Active');
        if(scrollToTabs){
            scrollToTabs();
        }
    }

/*********************************************************************** Таб :: Региионы ***/

            /*** Autocomplite :: Регионы ***/
            @if(!empty($content['filter']['regions_list']))
                var regions = [
                    @foreach($content['filter']['regions_list'] as $region)
                        {key:"{{$region['alias']}}",label:"{{$region['name']}}"},
                    @endforeach
                ];

            $( ".Autocomplete-Regions" ).autocomplete({
                source: regions,
                select: function (event, ui) {
                    /*** Запись параметров ***/
                    searchArray['region']=ui.item.key;
                    addToFilterSelected(this,'Region');
                    changeTab('.Tab-Categories');
                }
            });
            @endif

            /*** Клик :: Регионы ***/
            $('dd.Tab-Regions .Filter-Subcategory li>a').click(function(){
                if($('.Filter-Cities',$(this).parent()).length){
                    /*** Смена Регионов на Города ***/
                    var cities=$('.Filter-Cities',$(this).parent());
                    $('dd.Tab-Regions .Filter.Accordion').hide().after($(cities).clone());

                    /*** Запись параметров Региона ***/
                    searchArray['region']=$(this).attr('alias');
                    scrollToTabs();

                    /*** Вернуться в Категории ***/
                    $('.Tabs .Back').on('click',function(){
                        $('dd>div>.Filter-Cities').remove();
                        $('.Tab-Regions .Filter.Accordion').show();
                        scrollToTabs();
                        return false;
                    });
                }else{
                    /*** Параметры ***/
                    searchArray['region']=$(this).attr('alias');
                    addToFilterSelected(this,'Region');
                    changeTab('.Tab-Categories');
                }
                return false;
            });

            /*** Клик :: Выбор города ***/
            $(document).on('click','.Filter-Cities a',function(){
                searchArray['region']=$(this).attr('alias');
                addToFilterSelected(this,'Region');
                changeTab('.Tab-Categories');
                return false;
            });

/*********************************************************************************************************************** Таб :: Категории ***/

            /*** Autocomplite по Категориям ***/
            var categories = [
                @foreach($content['filter']['categories_list'] as $category)
                    {key:"{{$category['alias']}}",label:"{{$category['name']}}"},
                @endforeach
            ];

            $( ".Autocomplete-Categories" ).autocomplete({
                source: categories,
                select: function (event, ui) {
                    /*** Запись параметров ***/
                    searchArray['category']=ui.item.key;
                    getAjaxParams(searchArray['category']);
                    addToFilterSelected(this,'Category');

                    /*** Смена Таба Или Перескок на Главную страницу ***/
                    if(location.pathname!='/'){
                        changeTab('.Tab-Params');
                    }else{
                        filterSearch();
                    }
                }
            });

            /*** Клик :: Категории ***/
            $('dd.Tab-Categories a').click(function(){
                /*** Запись Параметров ***/
                searchArray['category']=$(this).attr('alias');
                addToFilterSelected(this,'Category');
                getAjaxParams(searchArray['category']);

                /*** Смена Таба Или Перескок на Главную страницу ***/
                if(location.pathname!='/'){
                    changeTab('.Tab-Params');
                }else{
                    filterSearch();
                }
                return false;
            });

/*********************************************************************************************************************** Таб :: Параметры :: Бренды ***/
            /*** Перебор всех чекбоксов ***/
            function checkedBrands(){
                var all_selected=true,
                    foreign_all_selected=true,
                    native_all_selected=true;
                $('.Accordion-Brands input[type=checkbox]').each(function(key,item){
                    if($(item).is(':checked') && $(item).attr('name')){
                        searchArray['brands['+key+']']=$(item).attr('name');
                    }else{
                        if($(item).attr('name')){
                            all_selected=false;
                        }
                        /*** Если выбраны все отечественные или не выбраны - переключаем select ***/
                        if(!$(item).is(':checked') && $(item).attr('name') && $(item).attr('foreign')=='0'){
                            native_all_selected=false;
                        }
                        /*** Если выбраны все зарубежные или не выбраны - переключаем select ***/
                        if(!$(item).is(':checked') && $(item).attr('name')&& $(item).attr('foreign')=='1'){
                            foreign_all_selected=false;
                        }
                        delete searchArray['brands['+key+']'];
                        delete searchArray[["brands%5B"+key+"%5D"]];
                    }
                });

                /*** Если один выбран ***/
                if(all_selected){
                    $('#all_brands').prop('checked','checked');
                }else{
                    $('#all_brands').prop('checked',false);
                }
                if(foreign_all_selected){
                    $('#foreign_brands').prop('checked','checked');
                }else{
                    $('#foreign_brands').prop('checked',false);
                }
                if(native_all_selected){
                    $('#native_brands').prop('checked','checked');
                }else{
                    $('#native_brands').prop('checked',false);
                }
            }

            /*** Клик :: Чекбокс ***/
            $('.Accordion-Brands input[type=checkbox]').click( function(){
                if($(this).attr('id')!='foreign_brands' &&
                    $(this).attr('id')!='native_brands' &&
                    $(this).attr('id')!='all_brands' ){
                    checkedBrands();
                }
            });

            /*** Клик на чекбокс "Выбрать все" ***/
            $('#all_brands').click(function(){
                if($(this).is(':checked')){
                    $('.Accordion-Brands input[type=checkbox]').prop('checked','checked');
                }else{
                    $('.Accordion-Brands input[type=checkbox]').prop('checked',false);
                }
                checkedBrands();
            });

            /*** Клик на чекбокс "Выбрать иномарки" ***/
            $('#foreign_brands').click(function(){
                if($(this).is(':checked')){
                    $('.Accordion-Brands input[foreign=1]').prop('checked','checked');
                }else{
                    $('.Accordion-Brands input[foreign=1]').prop('checked',false);
                }
                checkedBrands();
            });

            /*** Клик на чекбокс "Выбрать отечественные" ***/
            $('#native_brands').click(function(){
                if($(this).is(':checked')){
                    $('.Accordion-Brands input[foreign=0]').prop('checked','checked');
                }else{
                    $('.Accordion-Brands input[foreign=0]').prop('checked',false);
                }
                checkedBrands();
            });


/************************************************************************************************************ SLIDER PARAMS*/
            /*** Параметры ***/
            $("#Slider-Range-1").slider({
                range: true,
                min: 100,
                max: 50000,
                values: [ searchArray['price-min']?searchArray['price-min']:100, searchArray['price-max']?searchArray['price-max']:50000 ],
                slide: function( event, ui ) {
                    $("#Slider-Range-Value-1").text(ui.values[ 0 ] + " руб. - " + ui.values[ 1 ] +" руб.");
                    searchArray['price-min']=ui.values[ 0 ];
                    searchArray['price-max']= ui.values[ 1 ];
                }
            });

            $("#Slider-Range-Value-1").text(
                $( "#Slider-Range-1").slider( "values", 0 ) + " руб. - " + $( "#Slider-Range-1" ).slider( "values", 1 ) +" руб."
            );

            @if(!empty($content['filter']['params']))
                @foreach($content['filter']['params']['filters'] as $key => $param)
                    $("#Slider-Range-{{$param['alias']}}").slider({
                        range: true,
                        min: {{$param['min_value']}},
                        max: {{$param['max_value']}},
                        values: [ searchArray['params[{{$param["alias"]}}][min-value]']?searchArray['params[{{$param["alias"]}}][min-value]']:{{$param['min_value']}},
                                  searchArray['params[{{$param["alias"]}}][max-value]']?searchArray['params[{{$param["alias"]}}][max-value]']:{{$param['max_value']}} ],
                        slide: function( event, ui ) {
                            $("#Slider-Range-Value-{{$param["alias"]}}").text(ui.values[ 0 ] + "{{$param['dimension']}} - " + ui.values[ 1 ] +"{{$param['dimension']}}");
                            searchArray['params[{{$param["alias"]}}][min-value]']=ui.values[ 0 ];
                            searchArray['params[{{$param["alias"]}}][max-value]']= ui.values[ 1 ];
                            searchArray['params[{{$param["alias"]}}][id]']='{{$param["id"]}}';
                        }
                    });
                    $("#Slider-Range-Value-{{$param["alias"]}}").text(
                        $( "#Slider-Range-{{$param["alias"]}}").slider( "values", 0 ) + " {{$param['dimension']}} - " + $( "#Slider-Range-{{$param["alias"]}}" ).slider( "values", 1 ) + ' {{$param['dimension']}}'
                    );
                @endforeach
            @endif


/*********************************************************************************************************** Поиск ***/
        function filterSearch(){
            searchString='?';
            $.each(searchArray,function(key,value){
                if(key && value){
                    searchString+=key+'='+value+'&';
                }
            });
            location.href='{{$content["filter"]["type"]}}'+searchString;
              console.log('rent'+searchString);
        }
        $('#Filter-Search').click(function(){
            filterSearch();
        });


    /*
     Добавить на страницы "аренда, каталог, запчасти и сервис, арендодатели" рейтинг
     Привести в порядок лайтбокс
     Не нравится как выглядят Фотки для каталогов
     На Главной - Аренда стройтехники и производители (причесать)
     Кнопка меню в мобильной версии
     Скрыть фильтр в сплойлер на внутренних страницах
     */
</script>
@endsection


