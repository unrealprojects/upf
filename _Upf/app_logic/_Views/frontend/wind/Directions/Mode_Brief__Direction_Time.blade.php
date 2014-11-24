<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <table border="1">
        <tr>
            <td>t/m</td>
            @for($Month = 0; $Month < 24;$Month=$Month+3)
            <td>{{$Month}}-00</td>
            @endfor
        </tr>

        @foreach($WindMode['TimeModeBrief'] as $MonthKey => $Month)
            <tr>
                <td>{{$MonthKey}}</td>
                @foreach($Month as $TimeKey => $Time)
                    <td>{{$Time}}</td>
                @endforeach
            </tr>
        @endforeach

    </table>
</body>
</html>