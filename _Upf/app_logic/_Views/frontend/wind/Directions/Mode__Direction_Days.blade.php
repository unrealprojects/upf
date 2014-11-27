<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    @foreach($WindMode['DayMode'] as $YearKey => $Year)
    <h3>{{$YearKey}} г.</h3>
        <table border="1">
            <tr>
                <td>Месяц/День</td>
                @for($Day=1; $Day<=31;$Day++)
                <td>{{$Day}}</td>
                @endfor
            </tr>

            @foreach($Year as $MonthKey => $Month)
                <tr>
                    <td>{{$MonthKey}}</td>
                    @foreach($Month as $Day)
                        <td>{{$Day}}</td>
                    @endforeach
                </tr>
            @endforeach

        </table>
    @endforeach
</body>
</html>