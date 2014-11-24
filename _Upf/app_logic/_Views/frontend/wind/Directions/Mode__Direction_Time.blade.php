<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    @foreach($WindMode['TimeMode'] as $YearKey => $Year)
    <h3>{{$YearKey}} г.</h3>
        <table border="1">
            <tr>
                <td>Месяц/Время</td>
                @for($Month = 0; $Month < 24;$Month=$Month+3)
                <td>{{$Month}}-00</td>
                @endfor
            </tr>

            @foreach($Year as $MonthKey => $Month)
                <tr>
                    <td>{{$MonthKey}}</td>
                    @foreach($Month as $TimeKey => $Time)
                        <td>{{$Time}}</td>
                    @endforeach
                </tr>
            @endforeach

        </table>
    @endforeach
</body>
</html>
