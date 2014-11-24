<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
     @foreach($WindMode['MonthPercent'] as $YearKey => $Year )
     <h3>За {{$YearKey}}</h3>
     <table border="1">

         <tr>
             <td>Месяц/Направление</td>
             @foreach($WindMode['Directions'] as $Direction)
                 <td>{{$Direction}}</td>
             @endforeach
         </tr>

        @foreach($Year as $MonthKey => $Month)
         <tr>
             <td>{{$MonthKey}}</td>

             @foreach($WindMode['Directions'] as $Direction)
                 @if($Direction!='Ш')
                    <td>{{isset($Month[$Direction])?str_replace('.',',',round($Month[$Direction],3)*100):0}}</td>
                @else
                    <td>{{isset($Month[$Direction])?$Month[$Direction]:0}}</td>
                @endif
             @endforeach
         </tr>
        @endforeach

     </table>
     @endforeach
</body>
</html>