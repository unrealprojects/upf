@section('scripts')
@parent
<script>


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Start
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// -- First Tab

// If No Selected Items
$('.Tabs dt:first-of-type, .Tabs dd:first-of-type').addClass('Active');
// Else


// -- URI
var URI = location.pathname.split('/');
if(URI[1]==undefined){
    URI[1] = '';
}
if(URI[2]==undefined){
    URI[2] = '';
}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Helpers
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*** Анимация при смене табов ***/
function scrollToTabs(){
    $('body,html').animate({
        scrollTop: $('.Node.Filter').offset().top
    }, 400);
}

/*** Параметры для Категории ***/
function getAjaxParams($category_alias){
    filterSearch();
    /*$.ajax({
        type:'get',
        url:'/filter/' + $category_alias,
        dataType:'json',
        success:function(data){
            $('.Ajax-Params').remove();
            $('.Tab-Params .Form-Vertical>.Control-Group').first().after($('<div/>').html(data['params']).text());
            $('body').append($('<div/>').html(data['script']).text());
        }
    });*/
}

// Add To SELECTED
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

// Add To SELECTED
function addToFilterSelectedFromAutocomplete(element,name){
    if($('.Filter-Result').text().length){
        $("#Filter-Selected-"+name).remove();
        if(name=='Region'){
            $('.Filter-Result').prepend('<li id="Filter-Selected-'+name+'"><span>'+element.name+'</span><a class="Delete" alias="'+element.key+'" href="#">Удалить</a></li>');
        }else{
            $('.Filter-Result').append('<li id="Filter-Selected-'+name+'"><span>'+element.name+'</span><a class="Delete" alias="'+element.key+'" href="#">Удалить</a></li>');
        }
    }else{
        $('.Filter .Heading').after('<ul class="Filter-Result"><li id="Filter-Selected-'+name+'"><span>'+element.name+'</span><a class="Delete" alias="'+element.key+'" href="#">Удалить</a></li></ul>');
    }
}


// Удаление SELECTED Категорий и Регионов
$(document).on('click','#Filter-Selected-Region .Delete,' +
                       '#Filter-Selected-Category .Delete',function(){

    $(this).parent().remove();
    if(!$('.Filter-Result').text().length){
        $('.Filter-Result').remove();
    }
    if($(this).parent().is('#Filter-Selected-Region')){
        delete searchArray['region'];
        if($('.Tab-Regions').length){
            changeTab('.Tab-Regions');
        }
    }
    if($(this).parent().is('#Filter-Selected-Category')){
        delete searchArray['category'];
        if($('.Tab-Categories').length){
            changeTab('.Tab-Categories');
        }
    }
});

// Функция смены таба
function changeTab(tabName,ScrollUpToTabs){
    if(ScrollUpToTabs===undefined){ScrollUpToTabs=true;}
    $('.Tabs dt,.Tabs dd').removeClass('Active');
    $(tabName).addClass('Active');
    //if(ScrollUpToTabs){
        scrollToTabs();
   // }
}





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// SEARCH STRING
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
    if($('.Tab-Categories').length){
        changeTab('.Tab-Categories',false);
    }

}

if(searchArray['category']){
    addToFilterSelected($('[alias='+searchArray['category']+']'),'Category');
     if($('.Tab-Params').length){
            changeTab('.Tab-Params',false);
        }
}

if(searchArray['tags[0]']){
    $('.Input-Select input[type=text]').val(
        $('.Input-Select li[data-index='+(searchArray['tags[0]']+']')).text()
    );
}

/*
// Проверка Checkbox
var findtags = false;
for(var i=0;i<100;i++){
    if(!findtags && searchArray["tags["+i+"]"]){
        $('input[type=checkbox]').prop('checked',false);
        findtags=true;
    }
    $('input[name='+searchArray["tags["+i+"]"]).prop('checked',true);
    $('input[name='+searchArray["tags%5B"+i+"%5D"]).prop('checked',true);
}
if(findtags){
    checkedtags();
}

$(document).on('click','.Filter a',function()
{
    return false;
});
*/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Tab Regions
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//  Autocomplete :: Regions
@if(!empty($Content['Filters']['regions_list']))
    var regions = [
        @foreach($Content['Filters']['regions_list'] as $Region)
            {key:"{{$Region['alias']}}",label:"{{$Region['title']}}"},
        @endforeach
    ];

$( ".Autocomplete-Regions" ).autocomplete({
    source: regions,
    select: function (event, ui) {
        /*** Запись параметров ***/
        searchArray['region']=ui.item.key;
        var SelectedItem = {key:ui.item.key,name:ui.item.label};
        addToFilterSelectedFromAutocomplete(SelectedItem,'Category');
        if($('.Tab-Categories').length){
            changeTab('.Tab-Categories');
        }
    }
});
@endif

/*** Click :: Regions ***/
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
        if($('.Tab-Categories').length){
            changeTab('.Tab-Categories');
        }

    }
    return false;
});

/*** Клик :: Выбор города ***/
$(document).on('click','.Filter-Cities a',function(){
    searchArray['region']=$(this).attr('alias');
    addToFilterSelected(this,'Region');
    if($('.Tab-Categories').length){
        changeTab('.Tab-Categories');
    }else if($('.Tab-Params').length){
        changeTab('.Tab-Params');
    }
    return false;
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Tab :: Categories
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*** Autocomplite по Категориям ***/
var categories = [
    @foreach($Content['Filters']['categories_list'] as $Category)
        {key:"{{$Category['alias']}}",label:"{{$Category['title']}}"},
    @endforeach
];

$( ".Autocomplete-Categories" ).autocomplete({
    source: categories,
    select: function (event, ui) {
        /*** Запись параметров ***/
        searchArray['category']=ui.item.key;
        getAjaxParams(searchArray['category']);
        var SelectedItem = {key:ui.item.key,name:ui.item.label};
        addToFilterSelectedFromAutocomplete(SelectedItem,'Category');

        /*** Смена Таба Или Перескок на Главную страницу ***/
        if(location.pathname!='/'){
            if($('.Tab-Categories').length){
                changeTab('.Tab-Categories');
            }

        }else{
            filterSearch();
        }
    }
});

// -- Click To Categories
$('dd.Tab-Categories a').click(function(){
    /*** Запись Параметров ***/
    searchArray['category']=$(this).attr('alias');
    addToFilterSelected(this,'Category');
    getAjaxParams(searchArray['category']);

    // Go To Rent Page
    if(location.pathname!='/'){
        if($('.Tab-Params').length){
            changeTab('.Tab-Params');
        }
    }else{
        filterSearch();
    }
    return false;
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Tab :: Tags
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Перебор всех чекбоксов
/*
function checkedtags(){
    var all_selected=true,
        foreign_all_selected=true,
        native_all_selected=true;
    $('.Accordion-tags input[type=checkbox]').each(function(key,item){
        if($(item).is(':checked') && $(item).attr('name')){
            searchArray['tags['+key+']']=$(item).attr('name');
        }else{
            if($(item).attr('name')){
                all_selected=false;
            }
            // Если выбраны все отечественные или не выбраны - переключаем select
            if(!$(item).is(':checked') && $(item).attr('name') && $(item).attr('foreign')=='0'){
                native_all_selected=false;
            }
            // Если выбраны все зарубежные или не выбраны - переключаем select
            if(!$(item).is(':checked') && $(item).attr('name')&& $(item).attr('foreign')=='1'){
                foreign_all_selected=false;
            }
            delete searchArray['tags['+key+']'];
            delete searchArray[["tags%5B"+key+"%5D"]];
        }
    });

    // Если один выбран
    if(all_selected){
        $('#all_tags').prop('checked','checked');
    }else{
        $('#all_tags').prop('checked',false);
    }
    if(foreign_all_selected){
        $('#foreign_tags').prop('checked','checked');
    }else{
        $('#foreign_tags').prop('checked',false);
    }
    if(native_all_selected){
        $('#native_tags').prop('checked','checked');
    }else{
        $('#native_tags').prop('checked',false);
    }
}

// Клик :: Чекбокс
$('.Accordion-tags input[type=checkbox]').click( function(){
    if($(this).attr('id')!='foreign_tags' &&
        $(this).attr('id')!='native_tags' &&
        $(this).attr('id')!='all_tags' ){
        checkedtags();
    }
});

// Клик на чекбокс "Выбрать все"
$('#all_tags').click(function(){
    if($(this).is(':checked')){
        $('.Accordion-tags input[type=checkbox]').prop('checked','checked');
    }else{
        $('.Accordion-tags input[type=checkbox]').prop('checked',false);
    }
    checkedtags();
});

// Клик на чекбокс "Выбрать иномарки"
$('#foreign_tags').click(function(){
    if($(this).is(':checked')){
        $('.Accordion-tags input[foreign=1]').prop('checked','checked');
    }else{
        $('.Accordion-tags input[foreign=1]').prop('checked',false);
    }
    checkedtags();
});

// Клик на чекбокс "Выбрать отечественные"
$('#native_tags').click(function(){
    if($(this).is(':checked')){
        $('.Accordion-tags input[foreign=0]').prop('checked','checked');
    }else{
        $('.Accordion-tags input[foreign=0]').prop('checked',false);
    }
    checkedtags();
});
*/

////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Params
////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*** Параметры ***/
$("#Slider-Range-1").slider({
    range: true,
    min: 0,
    max: 1000000,
    values: [ searchArray['price-min']?searchArray['price-min']:0, searchArray['price-max']?searchArray['price-max']:1000000 ],
    slide: function( event, ui ) {
        $("#Slider-Range-Value-1").html(ui.values[ 0 ] + " - " + ui.values[ 1 ] +"  <span class='fa Icon-rub'></span>");
        searchArray['price-min'] = ui.values[ 0 ];
        searchArray['price-max'] = ui.values[ 1 ];
    }
});

$("#Slider-Range-Value-1").html(
    $( "#Slider-Range-1").slider( "values", 0 ) + " - " + $( "#Slider-Range-1" ).slider( "values", 1 ) +" <span class='Icon Icon-rub'></span>"
);

@if(!empty($Content['Filters']['params']))
    @foreach($Content['Filters']['params'] as $ParamKey => $Param)
        @if(!empty($Param['alias']) && !empty($Param['param_min']) && !empty($Param['param_max']))

            $("#Slider-Range-{{$Param['alias']}}").slider({
                range: true,
                min: {{$Param['param_min']}},
                max: {{$Param['param_max']}},
                values: [ searchArray['params[{{$Param["alias"]}}][min-value]']?searchArray['params[{{$Param["alias"]}}][min-value]']:{{$Param['param_min']}},
                          searchArray['params[{{$Param["alias"]}}][max-value]']?searchArray['params[{{$Param["alias"]}}][max-value]']:{{$Param['param_max']}} ],
                slide: function( event, ui ) {
                    $("#Slider-Range-Value-{{$Param["alias"]}}").text(ui.values[ 0 ] + "{{$Param['dimension']}} - " + ui.values[ 1 ] +"{{$Param['dimension']}}");
                    searchArray['params[{{$Param["alias"]}}][min-value]']=ui.values[ 0 ];
                    searchArray['params[{{$Param["alias"]}}][max-value]']= ui.values[ 1 ];
                    searchArray['params[{{$Param["alias"]}}][id]']='{{$Param["id"]}}';
                }
            });
            $("#Slider-Range-Value-{{$Param["alias"]}}").text(
                $( "#Slider-Range-{{$Param["alias"]}}").slider( "values", 0 ) + " {{$Param['dimension']}} - " + $( "#Slider-Range-{{$Param["alias"]}}" ).slider( "values", 1 ) + ' {{$Param['dimension']}}'
            );

        @endif
    @endforeach
@endif

$('.Input-Select-Content li').click(function(){
    searchArray['tags[0]'] = $(this).attr('data-index');
});


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Search
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function filterSearch(){
    searchString='?';
    $.each(searchArray,function(key,value){
        if(key && value){
            searchString+=key+'='+value+'&';
        }
    });
    if(URI[1]==''){
        console.log('rent'+searchString);
        location.href='rent' + searchString;

    }else{
        location.href = location.pathname + searchString;
    }
}

$('#Filter-Search').click(function(){
    filterSearch();
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
</script>
@endsection


