@extends('frontend.standard.content')

@foreach($avgDay as $param_name => $params_set)
<h3>Среднесуточное значение {{$param_name}}</h3>
<table border="1">
    <tr>
        <td>ym/d</td>
        @for($i=1; $i<32;$i++)
         <td>{{$i}}</td>
        @endfor
    </tr>
    @foreach($params_set as $key=>$list)
    <tr>
        <td>{{$key}}</td>
        @foreach($list as $value)
            <td>{{str_replace('.',',',round($value,2))}}</td>
        @endforeach
    </tr>
    @endforeach
</table>
@endforeach


@foreach($avgMonth as  $param_name => $params_set)
<h3>Среднемесячное значение {{$param_name}}</h3>
<table border="1">
    <tr>
        <td>y/m</td>
        @for($i=1; $i<=12;$i++)
        <td>{{$i}}</td>
        @endfor
    </tr>
    @foreach($params_set as $key=>$list)

    <tr>
        <td>{{$key}}</td>
        @foreach($list as $value)
        <td>{{str_replace('.',',',round($value,2))}}</td>
        @endforeach
    </tr>
    @endforeach
</table>
@endforeach