<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
    <table border="1">
        <tr>
            <td>Квартал/Время</td>
             @foreach($WindMode['Winds'] as $Wind)
            <td>{{$Wind}}</td>
            @endforeach
        </tr>

        @foreach($WindMode['VelocityTimesQuarters'] as $YearKey => $Year )
            <tr>
                <td>{{$YearKey}}</td>
                @foreach($WindMode['Winds'] as $Wind)
                    <td>{{isset($Year[$Wind])?str_replace('.',',',round($Year[$Wind],3)*100):0}}</td>
                @endforeach
            </tr>
        @endforeach

    </table>
</body>
</html>