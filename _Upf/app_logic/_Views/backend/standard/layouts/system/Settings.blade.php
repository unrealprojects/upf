@extends($template)

@section('main')
<section class="Content">
    <h3 class="Heading Secondary">Редактирование</h3>
    <div class="Content-Inner">
        <form class="" action="">

            <div class="Form-Group">
                <div class="Control-Group">
                    <label class="Node-XXS-3" for="">Input</label>
                    <input class="Node-XXS-9" type="text" value="Just an ordinary input. Nothing to see here"/>
                </div>
                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Input Error</label>
                    <div class="Input-Group Error Node-XS-9">
                        <input class="Error" type="text" value="Bad input"/>
                        <span class="Message">Woops! Error</span>
                    </div>
                </div>
                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Disabled Input</label>
                    <input class="Node-XS-9" type="text" value="Disabled Input" disabled/>
                </div>
                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Ghost Input</label>
                    <input class="Node-XS-9 Ghost" type="text" readonly value="Ghost input"/>
                </div>

                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Default Select</label>
                    <select class="Node-XS-9">
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                </div>

                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Default Textarea</label>
                    <textarea class="Node-XS-9">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eius, modi. Consequuntur, quos adipisci harum, ad, dolorem vero excepturi eveniet eum minus dignissimos consequatur vel. Dolore voluptatibus voluptatum quaerat saepe.</textarea>
                </div>

            </div>



            <div class="Form-Group">
                <div class="Control-Group">
                    <label for="" class="Node-XS-3">Input-Group Split</label>
                    <div class="Input-Group Node-XS-9 Grid Split">
                        <input type="text" class="Node-XXS-4" />
                        <input type="text" class="Node-XXS-4" />
                        <input type="text" class="Node-XXS-4" />
                    </div>
                </div>
                <div class="Control-Group">
                    <label for="" class="Node-XS-3">Input-Group Merge</label>
                    <div class="Input-Group Node-XS-9 Grid Merge">
                        <input type="text" class="Node-XXS-4" />
                        <input type="text" class="Node-XXS-4" />
                        <input type="text" class="Node-XXS-4" />
                    </div>
                </div>
                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Input-Group Vertical</label>
                    <div class="Input-Group Vertical Node-XS-9">
                        <input type="text" />
                        <input type="text" />
                        <input type="text" />
                    </div>
                </div>
            </div>



            <div class="Form-Group">
                <div class="Control-Group">
                    <label for="" class="Node-XS-3">Input-Group Prefix</label>
                    <div class="Input-Group Prefix Node-XS-9 Grid Merge">
                        <span class="Node-XXS-1">@</span>
                        <input type="text" class="Node-XXS-11" />
                    </div>
                </div>

                <div class="Control-Group">
                    <label for="demo-1" class="Node-XS-3">Input-Group Postfix</label>
                    <div class="Input-Group Postfix Node-XS-9 Grid Merge">
                        <input id="demo-1" type="text" class="Node-XXS-11" />
                        <label for="demo-1" class="Node-XXS-1">.00</label>
                    </div>
                </div>
            </div>



            <div class="Form-Group">
                <div class="Control-Group">
                    <label for="" class="Node-XS-3">Input-Group Button 1</label>
                    <div class="Input-Group Button Node-XS-9 Grid Merge">
                        <input type="text" class="Node-XXS-10" />
                        <input type="button" class="Node-XXS-2" value="Check"/>
                    </div>
                </div>
                <div class="Control-Group">
                    <label for="" class="Node-XS-3">Input-Group Button 2</label>
                    <div class="Input-Group Button Node-XS-9 Grid Merge">
                        <input type="button" class="Node-XXS-2" value="Check"/>
                        <input type="text" class="Node-XXS-10" />
                    </div>
                </div>
            </div>
            <div class="Form-Group">
                <div class="Control-Group">
                    <label for="" class="Node-XS-3">File upload</label>
                    <div class="Input-Group Upload Node-XS-9">
                        <input class="" type="file" />
                        <ul class="Grid Split">
                            <li class="Node-XS-3"><a href="#" class="Link-Delete">Удалить</a><img src="http://lorempixel.com/300/300/sports/5" alt="" /></li>
                            <li class="Node-XS-3"><a href="#" class="Link-Delete">Удалить</a><img src="http://lorempixel.com/300/300/sports/5" alt="" /></li>
                            <li class="Node-XS-3"><a href="#" class="Link-Delete">Удалить</a><img src="http://lorempixel.com/300/300/sports/5" alt="" /></li>
                            <li class="Node-XS-3"><a href="#" class="Link-Delete">Удалить</a><img src="http://lorempixel.com/300/300/sports/5" alt="" /></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="Form-Group">
                <div class="Control-Group">
                    <input class="Node-XS-3 Push-3" type="submit" />
                </div>
            </div>

        </form>


        <form class="Wide" id="Edit-Item" enctype="multipart/form-data">
            @foreach($content['data'] as $relation => $setting)
                {{---------------------------------------------------------------------------------------------------------------------- Text Field --}}
                @if($setting['type']=='text')
                    <div class="Control-Group">
                        <label for="field_{{$relation}}">{{$setting['title']}}</label>
                        <input name="{{$relation}}" id="field_{{$relation}}" type="text" value="{{$setting['content']}}"/>
                    </div>
                {{---------------------------------------------------------------------------------------------------------------------- Text Field --}}
                @elseif($setting['type']=='numeric')
                    <div class="Control-Group">
                        <label for="field_{{$relation}}">{{$setting['title']}}</label>
                        <input name="{{$relation}}" id="field_{{$relation}}" type="number" value="{{$setting['content']}}"/>
                    </div>
                @endif
            @endforeach
            <input class="Button Round" type="submit" value="Обновить"/>
        </form>
    </div>
</section>
@endsection