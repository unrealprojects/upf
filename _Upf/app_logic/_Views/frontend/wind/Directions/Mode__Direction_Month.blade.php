<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <table border="1">
        <tr>
            <td>Год/Месяц</td>
            @for($Month = 1; $Month <= 12;$Month++)
            <td>{{$Month}}</td>
            @endfor
        </tr>
        @foreach($WindMode['MonthMode'] as $YearKey => $Year )
        <tr>
            <td>{{$YearKey}}</td>
            @foreach($Year as $MonthKey => $Month)
                <td>{{$Month}}</td>
            @endforeach
        </tr>
        @endforeach
    </table>
</body>
</html>