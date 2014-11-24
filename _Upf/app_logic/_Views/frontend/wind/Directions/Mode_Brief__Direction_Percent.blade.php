<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
     <table border="1">

         <tr>
             @foreach($WindMode['Directions'] as $Direction)
                 <td>{{$Direction}}</td>
             @endforeach
         </tr>

         <tr>
             @foreach($WindMode['Directions'] as $Direction)
                 @if($Direction!='Ш')
                    <td>{{isset($WindMode['MonthPercent_Brief'][$Direction])?str_replace('.',',',round($WindMode['MonthPercent_Brief'][$Direction],3)*100):0}}</td>
                 @else
                    <td>{{isset($WindMode['MonthPercent_Brief'][$Direction])?$WindMode['MonthPercent_Brief'][$Direction]:0}}</td>
                 @endif
             @endforeach
         </tr>
     </table>
</body>
</html>