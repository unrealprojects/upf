<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

@foreach($AvgDay['WindVelocity'] as $YearKey=>$Year)
<h3>{{$YearKey}} г.</h3>
    <table border="1">
        <tr>
            <td>Месяц/День</td>
            @for($i=1; $i<32;$i++)
                <td>{{$i}}</td>
            @endfor
        </tr>
        @foreach($Year as $MonthKey=>$Month)
        <tr>
            <td>{{$MonthKey}}</td>
            @foreach($Month as $Day)
                <td>{{str_replace('.',',',round($Day,2))}}</td>
            @endforeach
        </tr>
        @endforeach
    </table>
@endforeach

</body>
</html>