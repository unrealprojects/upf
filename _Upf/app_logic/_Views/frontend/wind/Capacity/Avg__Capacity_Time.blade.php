<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    @foreach($WindMode['TimeAvg'] as $YearKey => $Year)
    <h3>{{$YearKey}} г.</h3>
        <table border="1">
            <tr>
                <td>Месяц/Час</td>
                @for($Month = 0; $Month < 24;$Month=$Month+3)
                <td>{{$Month}}-00</td>
                @endfor
            </tr>

            @foreach($Year as $MonthKey => $Month)
                <tr>
                    <td>{{$MonthKey}}</td>
                    @foreach($Month as $TimeKey => $Time)
                        <td>{{str_replace('.',',',round($Time,2))}}</td>
                    @endforeach
                </tr>
            @endforeach

        </table>
    @endforeach
</body>
</html>