<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

    <table border="1">
        <tr>
            <td>Год/Месяц</td>
            @for($i=1; $i<=12;$i++)
            <td>{{$i}}</td>
            @endfor
        </tr>
        @foreach($AvgMonth['WindVelocity'] as $YearKey=>$Year)
        <tr>
            <td>{{$YearKey}}</td>
            @foreach($Year as $Month)
            <td>{{str_replace('.',',',round($Month,2))}}</td>
            @endforeach
        </tr>
        @endforeach
    </table>

</body>
</html>