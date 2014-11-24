<?php
namespace Controller\Frontend\WindSpace;

class WindController extends \Controller {






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Index
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function Index()
{
    $Names = [
        //'amvrosievka',
        //'askania-nova',
        //'belovodsk',
        //'berdyansk',
        //'botievo',

        //'chaplino',
        //'genichensk',
        //'gulyaypole',
        //'izum',
        //'kamensk-shachtinskiy',

        //'kupyansk',
        //'lozovaya',
        //'mariupol',
        //'matveev_curgan',
        'melitopol',

        //'millerovo',
        //'new_kohovka',
        //'novodarevka',
        //'novopskov',
        //'prishib',

        //'tagonrog',
        //'troickoe',
        //'udachnoe',
        //'volnovaha',
        //'shachtu',
    ];

    $Html = '';
    foreach($Names as $KeyName => $Name){

            $Html .= $this->Execute($Name);

    }
    return $Html;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Index
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Execute($Name)
    {
        // Parse CSV

        $Csv = file(base_path() . '/public/data/excel/' . $Name . '.csv');
        $Data = [];

        for ($i = 1; $i < count($Csv); $i++) {
            $Data[$i] = str_getcsv($Csv[$i], ';');
        }

        $Data = array_reverse($Data);

        // Get Statics

        $ViewData = [
            'Title' => $Name,
            'AvgDay'=>
                [
                    'Temp' =>                   $this->GetAvgDay($Data, 1),
                    'Pressure' =>               $this->GetAvgDay($Data, 3),
                    'Pressure0' =>              $this->GetAvgDay($Data, 2),
                    'WindVelocity' =>           $this->GetAvgDay($Data, 7),
                    'Wetness' =>                $this->GetAvgDay($Data, 5)
                ],
            'AvgMonth'=>
                [
                    'Temp' =>                   $this->GetAvgMonth($Data, 1),
                    'Pressure' =>               $this->GetAvgMonth($Data, 3),
                    'Pressure0' =>              $this->GetAvgMonth($Data, 2),
                    'WindVelocity' =>           $this->GetAvgMonth($Data, 7),
                    'Wetness' =>                $this->GetAvgMonth($Data, 5)
                ],
            'WindMode' =>
                [
                    'Directions' =>             $this->Directions(),
                    'DayMode' =>                $this->GetDayMode($Data, 6),
                    'MonthMode' =>              $this->GetMonthMode($Data, 6),
                    'TimeMode' =>               $this->GetModeDirectionForOut($Data, 6),
                    'TimeModeBrief' =>          $this->GetModeDirectionForOutBrief($Data, 6),
                    'MonthPercent' =>           $this->Get__Direction_Month_Percent($Data, 6),
                    'MonthPercent_Brief' =>     $this->Get_Brief__Direction_Month_Percent($Data, 6),

                    'Winds' =>                  $this->Winds(),
                    'DayMax' =>                 $this->GetDayMaxCapacity($Data, 7),
                    'MonthMax' =>               $this->GetMonthMaxCapacity($Data, 7),
                    'TimeAvg' =>                $this->GetSpeedEachHour($Data, 7),
                    'VelocityTimesYear' =>      $this->Get__Velocity_Times_Year($Data, 7),
                    'VelocityTimesQuarters' =>  $this->Get__Velocity_Times_Quarter($Data, 7),
                ]

        ];

        // To Excel

        \Maatwebsite\Excel\Facades\Excel::create($Name, function($Excel) use($ViewData){

            $Excel->sheet('Среднесуточное Давление', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Avg/Avg__Pressure_Days',$ViewData);
            });

            $Excel->sheet('Среднемесячное Давление', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Avg/Avg__Pressure_Months',$ViewData);
            });


            $Excel->sheet('Среднесуточная Температура', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Avg/Avg__Temperature_Days',$ViewData);
            });

            $Excel->sheet('Среднемесячное Температура', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Avg/Avg__Temperature_Months',$ViewData);
            });


            $Excel->sheet('Среднесуточная Влажность', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Avg/Avg__Wetness_Days',$ViewData);
            });

            $Excel->sheet('Среднемесячное Влажность', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Avg/Avg__Wetness_Months',$ViewData);
            });


            $Excel->sheet('Среднесуточная Скорость Ветра', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Avg/Avg__WindVelocity_Days',$ViewData);
            });

            $Excel->sheet('Среднемесячное Скорость Ветра', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Avg/Avg__WindVelocity_Months',$ViewData);
            });


            $Excel->sheet('Скорость ветра по времени', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Capacity/Avg__Capacity_Time',$ViewData);
            });

            $Excel->sheet('Максимальная Ск Ветра за сутки', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Capacity/Max__Capacity_Day',$ViewData);
            });

            $Excel->sheet('Максимальная Ск Ветра за месяц', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Capacity/Max__Capacity_Month',$ViewData);
            });

            $Excel->sheet('Повторяемость Ск Ветра за сезон', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Capacity/Times_Capacity_Quarters',$ViewData);
            });

            $Excel->sheet('Повторяемость Ск Ветра за год', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Capacity/Times_Capacity_Year',$ViewData);
            });



            $Excel->sheet('Мода по Напр Ветра за сутки', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Directions/Mode__Direction_Days',$ViewData);
            });

            $Excel->sheet('Мода по Напр Ветра за месяц', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Directions/Mode__Direction_Month',$ViewData);
            });

            $Excel->sheet('Процент преобл по Напр. Ветра', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Directions/Mode__Direction_Percent_Month',$ViewData);
            });

            $Excel->sheet('Сводка Процент преобл по Напр', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Directions/Mode_Brief__Direction_Percent',$ViewData);
            });

            $Excel->sheet('Мода по Напр Ветра по врем', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Directions/Mode__Direction_Time',$ViewData);
            });

            $Excel->sheet('Сводка Мода по Напр по врем', function($Sheet) use($ViewData){
                $Sheet->loadView('/frontend/wind/Directions/Mode_Brief__Direction_Time',$ViewData);
            });

        })->export('xlsx');

        //return \View::make('/frontend/wind/Main', $ViewData);
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get :: Average Day Value
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function GetAvgDay($Data,$ItemKey){

    $DateKey = 0;
    $Result = [];

    // To Array
    foreach($Data as $KeyTime => $Time)
    {
        $CurrentData = array_reverse(
            explode( '.', substr($Time[$DateKey], 0, 10) )
        );

        if( !isset($Result[(int)$CurrentData[0]][(int)$CurrentData[1]][(int)$CurrentData[2]]['value']) )
        {
            $Result[(int)$CurrentData[0]][(int)$CurrentData[1]][(int)$CurrentData[2]]['value'] = $Time[$ItemKey];
            $Result[(int)$CurrentData[0]][(int)$CurrentData[1]][(int)$CurrentData[2]]['count'] = 1;
        }
        else
        {
            $Result[(int)$CurrentData[0]][(int)$CurrentData[1]][(int)$CurrentData[2]]['value'] += $Time[$ItemKey];
            $Result[(int)$CurrentData[0]][(int)$CurrentData[1]][(int)$CurrentData[2]]['count']++;
        }

    }

    // Make Mode
    foreach($Result as $Key_1 => $Value_1){
        foreach($Value_1 as $Key_2 => $Value_2){
            foreach($Value_2 as $Key_3 => $Value_3){
                $Result[$Key_1][$Key_2][$Key_3] = $Value_3['value']/$Value_3['count'];
            }
        }
    }

    return $Result;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get :: Average Day Value
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function GetAvgMonth($Data,$ItemKey)
{
    $DateKey = 0;
    $Result = [];

    // To Array
    foreach($Data as $KeyTime => $Time)
    {

        // Date Format :: [0 => y, 1 => m, 2 => d]
        $CurrentData = array_reverse(
            explode( '.', substr($Time[$DateKey], 0, 10) )
        );


        if( !isset($Result[(int)$CurrentData[0]][(int)$CurrentData[1]]['value']) )
        {
            $Result[(int)$CurrentData[0]][(int)$CurrentData[1]]['value'] = $Time[$ItemKey];
            $Result[(int)$CurrentData[0]][(int)$CurrentData[1]]['count'] = 1;
        }
        else
        {
            $Result[(int)$CurrentData[0]][(int)$CurrentData[1]]['value'] += $Time[$ItemKey];
            $Result[(int)$CurrentData[0]][(int)$CurrentData[1]]['count']++;
        }

    }
    // Make Mode
    foreach($Result as $Key_1 => $Value_1){
        foreach($Value_1 as $Key_2 => $Value_2){
            $Result[$Key_1][$Key_2] = $Value_2['value']/$Value_2['count'];

        }
    }

    return $Result;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get :: Wind Direction Mode for Day
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function GetDayMode($Data,$ItemKey)
{
    $DateKey = 0;
    $Result = [];

    // To Array
    foreach($Data as $KeyTime => $Time)
    {

        $Replaces = [
            'Ветер, дующий с севера' =>                     'Пн',
            'Ветер, дующий с северо-северо-востока' =>      'ПнПнСх',
            'Ветер, дующий с северо-востока' =>             'ПнСх',
            'Ветер, дующий с востоко-северо-востока' =>     'СхПнСх',
            'Ветер, дующий с востока' =>                    'Сх',
            'Ветер, дующий с востоко-юго-востока' =>        'СхПдСх',
            'Ветер, дующий с юго-востока' =>                'ПдСх',
            'Ветер, дующий с юго-юго-востока' =>            'ПдПдСх',
            'Ветер, дующий с юга' =>                        'Пд',
            'Ветер, дующий с юго-юго-запада' =>             'ПдПдЗх',
            'Ветер, дующий с юго-запада' =>                 'ПдЗх',
            'Ветер, дующий с западо-юго-запада' =>          'ЗхПдЗх',
            'Ветер, дующий с запада' =>                     'Зх',
            'Ветер, дующий с западо-северо-запада' =>       'ЗхПнЗх',
            'Ветер, дующий с северо-запада' =>              'ПнЗх',
            'Ветер, дующий с северо-северо-запада' =>       'ПнПнЗх',
            'Штиль, безветрие' =>                           'Ш',
        ];

        foreach($Replaces as $ReplaceKey => $Replace)
        {
            $Time[$ItemKey] = str_replace($ReplaceKey, $Replace, $Time[$ItemKey]);
        }

        // Date Format :: [0 => y, 1 => m, 2 => d]
        $CurrentData = array_reverse(
            explode( '.', substr($Time[$DateKey], 0, 10) )
        );

        $Result[(int)$CurrentData[0]][(int)$CurrentData[1]][(int)$CurrentData[2]][] = $Time[$ItemKey];

    }

    // Make Mode
    foreach($Result as $Key_1 => $Value_1){
        foreach($Value_1 as $Key_2 => $Value_2){
            foreach($Value_2 as $Key_3 => $Value_3){
                $Mode = [];
                foreach($Value_3 as $ModeKey => $Item){
                    if( empty( $Mode[$Item] ) )
                    {
                        $Mode[$Item] = 1;
                    }
                    else
                    {
                        $Mode[$Item]++;
                    }
                }

                $Mode = array_keys($Mode, max($Mode));
                $Result[$Key_1][$Key_2][$Key_3] = $Mode[0];
            }
        }
    }
    return $Result;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get :: Wind Direction Mode for Month
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function GetMonthMode($Data,$ItemKey)
{
    $DateKey = 0;
    $Result = [];

    // To Array
    foreach($Data as $KeyTime => $Time)
    {
        $Replaces = [
            'Ветер, дующий с севера' =>                     'Пн',
            'Ветер, дующий с северо-северо-востока' =>      'ПнПнСх',
            'Ветер, дующий с северо-востока' =>             'ПнСх',
            'Ветер, дующий с востоко-северо-востока' =>     'СхПнСх',
            'Ветер, дующий с востока' =>                    'Сх',
            'Ветер, дующий с востоко-юго-востока' =>        'СхПдСх',
            'Ветер, дующий с юго-востока' =>                'ПдСх',
            'Ветер, дующий с юго-юго-востока' =>            'ПдПдСх',
            'Ветер, дующий с юга' =>                        'Пд',
            'Ветер, дующий с юго-юго-запада' =>             'ПдПдЗх',
            'Ветер, дующий с юго-запада' =>                 'ПдЗх',
            'Ветер, дующий с западо-юго-запада' =>          'ЗхПдЗх',
            'Ветер, дующий с запада' =>                     'Зх',
            'Ветер, дующий с западо-северо-запада' =>       'ЗхПнЗх',
            'Ветер, дующий с северо-запада' =>              'ПнЗх',
            'Ветер, дующий с северо-северо-запада' =>       'ПнПнЗх',
            'Штиль, безветрие' =>                           'Ш',
        ];


        foreach($Replaces as $ReplaceKey => $Replace)
        {
            $Time[$ItemKey] = str_replace($ReplaceKey, $Replace, $Time[$ItemKey]);
        }

        // Date Format :: [0 => y, 1 => m, 2 => d]
        $CurrentData = array_reverse(
            explode( '.', substr($Time[$DateKey], 0, 10) )
        );

        $Result[(int)$CurrentData[0]][(int)$CurrentData[1]][] = $Time[$ItemKey];

    }

    // Make Mode
    foreach($Result as $Key_1 => $Value_1){
        foreach($Value_1 as $Key_2 => $Value_2){
            $Mode = [];
            foreach($Value_2 as $ModeKey => $Item){
                if( empty( $Mode[$Item] ) )
                {
                    $Mode[$Item] = 1;
                }
                else
                {
                    $Mode[$Item]++;
                }
            }

            $Mode = array_keys($Mode, max($Mode));
            $Result[$Key_1][$Key_2] = $Mode[0];
        }
    }

    return $Result;

}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get :: Wind Direction for Month - Percent
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Get__Direction_Month_Percent($Data,$ItemKey)
    {
        $DateKey = 0;
        $Result = [];

        // To Array
        foreach($Data as $KeyTime => $Time)
        {
            $Replaces = [
                'Ветер, дующий с севера' =>                     'Пн',
                'Ветер, дующий с северо-северо-востока' =>      'ПнПнСх',
                'Ветер, дующий с северо-востока' =>             'ПнСх',
                'Ветер, дующий с востоко-северо-востока' =>     'СхПнСх',
                'Ветер, дующий с востока' =>                    'Сх',
                'Ветер, дующий с востоко-юго-востока' =>         'СхПдСх',
                'Ветер, дующий с юго-востока' =>                'ПдСх',
                'Ветер, дующий с юго-юго-востока' =>            'ПдПдСх',
                'Ветер, дующий с юга' =>                        'Пд',
                'Ветер, дующий с юго-юго-запада' =>             'ПдПдЗх',
                'Ветер, дующий с юго-запада' =>                 'ПдЗх',
                'Ветер, дующий с западо-юго-запада' =>          'ЗхПдЗх',
                'Ветер, дующий с запада' =>                     'Зх',
                'Ветер, дующий с западо-северо-запада' =>       'ЗхПнЗх',
                'Ветер, дующий с северо-запада' =>              'ПнЗх',
                'Ветер, дующий с северо-северо-запада' =>       'ПнПнЗх',
                'Штиль, безветрие' =>                           'Ш',
                '' =>                                           'Ш',
                ' ' =>                                          'Ш'
            ];


            foreach($Replaces as $ReplaceKey => $Replace)
            {
                $Time[$ItemKey] = str_replace($ReplaceKey, $Replace, $Time[$ItemKey]);
            }

            // Date Format :: [0 => y, 1 => m, 2 => d]
            $CurrentData = array_reverse(
                explode( '.', substr($Time[$DateKey], 0, 10) )
            );

            // Month
            if(isset($Result[(int)$CurrentData[0]][(int)$CurrentData[1]]['Direct'][$Time[$ItemKey]]))
            {
                    $Result[(int)$CurrentData[0]][(int)$CurrentData[1]]['Direct'][$Time[$ItemKey]]++;
            }else{
                    $Result[(int)$CurrentData[0]][(int)$CurrentData[1]]['Direct'][$Time[$ItemKey]] = 1;
            }

            // Month
            if( isset($Result[(int)$CurrentData[0]][(int)$CurrentData[1]]['Count']) )
            {
                if($Time[$ItemKey]!='Ш') {
                    $Result[(int)$CurrentData[0]][(int)$CurrentData[1]]['Count']++;
                }
            }else{
                if($Time[$ItemKey]!='Ш') {
                    $Result[(int)$CurrentData[0]][(int)$CurrentData[1]]['Count'] = 1;
                }
            }

        }

        // Make Mode
        foreach($Result as $Key_1 => $Value_1){
            foreach($Value_1 as $Key_2 => $Value_2){
                foreach($Value_2['Direct'] as $Key_3 => $Value_3){
                    if($Key_3!='Ш') {
                        $Result[$Key_1][$Key_2][$Key_3] = $Value_3 / $Value_2['Count'];
                    }else{
                        $Result[$Key_1][$Key_2][$Key_3] = $Value_3;
                    }
                }

            }
        }

        return $Result;
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get :: Wind Direction for Month - Percent - Brief
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Get_Brief__Direction_Month_Percent($Data,$ItemKey)
    {
        $DateKey = 0;
        $Result = [];

        // To Array
        foreach($Data as $KeyTime => $Time)
        {
            $Replaces = [
                'Ветер, дующий с севера' =>                     'Пн',
                'Ветер, дующий с северо-северо-востока' =>      'ПнПнСх',
                'Ветер, дующий с северо-востока' =>             'ПнСх',
                'Ветер, дующий с востоко-северо-востока' =>     'СхПнСх',
                'Ветер, дующий с востока' =>                    'Сх',
                'Ветер, дующий с востоко-юго-востока' =>         'СхПдСх',
                'Ветер, дующий с юго-востока' =>                'ПдСх',
                'Ветер, дующий с юго-юго-востока' =>            'ПдПдСх',
                'Ветер, дующий с юга' =>                        'Пд',
                'Ветер, дующий с юго-юго-запада' =>             'ПдПдЗх',
                'Ветер, дующий с юго-запада' =>                 'ПдЗх',
                'Ветер, дующий с западо-юго-запада' =>          'ЗхПдЗх',
                'Ветер, дующий с запада' =>                     'Зх',
                'Ветер, дующий с западо-северо-запада' =>       'ЗхПнЗх',
                'Ветер, дующий с северо-запада' =>              'ПнЗх',
                'Ветер, дующий с северо-северо-запада' =>       'ПнПнЗх',
                'Штиль, безветрие' =>                           'Ш',
                '' =>                                           'Ш',
                ' ' =>                                          'Ш'
            ];


            foreach($Replaces as $ReplaceKey => $Replace)
            {
                $Time[$ItemKey] = str_replace($ReplaceKey, $Replace, $Time[$ItemKey]);
            }

            // Month
            if(isset($Result['Direct'][$Time[$ItemKey]]))
            {
                    $Result['Direct'][$Time[$ItemKey]]++;
            }else{
                    $Result['Direct'][$Time[$ItemKey]] = 1;
            }

            // Month
            if( isset($Result['Count']) )
            {
                if($Time[$ItemKey]!='Ш') {
                    $Result['Count']++;
                }
            }else{
                if($Time[$ItemKey]!='Ш') {
                    $Result['Count'] = 1;
                }
            }


        }

        // Make Mode
        foreach($Result['Direct'] as $Key_1 => $Value_1){
            if($Key_1!='Ш') {
                $Result[$Key_1] = $Value_1 / $Result['Count'];
            }else{
                $Result[$Key_1] = $Value_1;
            }
        }

//        echo '<meta charset="utf-8">';
//        print_r($Result);exit;
        return $Result;

    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get :: Get Mode Direction For Each Hour
////
// January(1), April(4), July (7), October (10)
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function GetModeDirectionForOut($Data,$ItemKey)
    {
        $DateKey = 0;
        $Result = [];

        // To Array
        foreach($Data as $KeyTime => $Time)
        {
            $Replaces = [
                'Ветер, дующий с севера' =>                     'Пн',
                'Ветер, дующий с северо-северо-востока' =>      'ПнПнСх',
                'Ветер, дующий с северо-востока' =>             'ПнСх',
                'Ветер, дующий с востоко-северо-востока' =>     'СхПнСх',
                'Ветер, дующий с востока' =>                    'Сх',
                'Ветер, дующий с востоко-юго-востока' =>         'СхПдСх',
                'Ветер, дующий с юго-востока' =>                'ПдСх',
                'Ветер, дующий с юго-юго-востока' =>            'ПдПдСх',
                'Ветер, дующий с юга' =>                        'Пд',
                'Ветер, дующий с юго-юго-запада' =>             'ПдПдЗх',
                'Ветер, дующий с юго-запада' =>                 'ПдЗх',
                'Ветер, дующий с западо-юго-запада' =>          'ЗхПдЗх',
                'Ветер, дующий с запада' =>                     'Зх',
                'Ветер, дующий с западо-северо-запада' =>       'ЗхПнЗх',
                'Ветер, дующий с северо-запада' =>              'ПнЗх',
                'Ветер, дующий с северо-северо-запада' =>       'ПнПнЗх',
                'Штиль, безветрие' =>                           'Ш',
            ];


            foreach($Replaces as $ReplaceKey => $Replace)
            {
                $Time[$ItemKey] = str_replace($ReplaceKey, $Replace, $Time[$ItemKey]);
            }

            // Date Format :: [0 => y, 1 => m, 2 => d]
            $CurrentData = array_reverse(
                explode( '.', substr($Time[$DateKey], 0, 10) )
            );

            $CurrentTime = substr($Time[$DateKey], 11, 5);

            $Replaces = [
                '24:00' => '00:00',
                '01:00' => '00:00',
                '02:00' => '00:00',

                '04:00' => '03:00',
                '05:00' => '03:00',

                '07:00' => '06:00',
                '08:00' => '06:00',

                '10:00' => '09:00',
                '11:00' => '09:00',

                '13:00' => '12:00',
                '14:00' => '12:00',

                '16:00' => '15:00',
                '17:00' => '15:00',

                '19:00' => '18:00',
                '20:00' => '18:00',

                '22:00' => '21:00',
                '23:00' => '21:00'

            ];


            foreach($Replaces as $ReplaceKey => $Replace)
            {
                $CurrentTime = str_replace($ReplaceKey, $Replace, $CurrentTime);
            }



            if((int)$CurrentData[1]==1 || (int)$CurrentData[1]==4 || (int)$CurrentData[1]==7 || (int)$CurrentData[1]==10)
            {
                $Result[(int)$CurrentData[0]][(int)$CurrentData[1]][$CurrentTime][] = $Time[$ItemKey];
            }

        }

        // Make Mode
        foreach($Result as $Key_1 => $Value_1){
            foreach($Value_1 as $Key_2 => $Value_2){
                foreach($Value_2 as $Key_3 => $Value_3) {
                    $Mode = [];
                    foreach ($Value_3 as $ModeKey => $Item) {
                        if (empty($Mode[$Item])) {
                            $Mode[$Item] = 1;
                        } else {
                            $Mode[$Item]++;
                        }
                    }

                    $Mode = array_keys($Mode, max($Mode));
                    $Result[$Key_1][$Key_2][$Key_3] = $Mode[0];
                }
            }
        }

        return $Result;
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////







////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get :: Velocity Times Year
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Get__Velocity_Times_Year($Data,$ItemKey)
    {
        $DateKey = 0;
        $Result = [];

        // To Array
        foreach($Data as $KeyTime => $Time)
        {

            // Date Format :: [0 => y, 1 => m, 2 => d]
            $CurrentData = array_reverse(
                explode( '.', substr($Time[$DateKey], 0, 10) )
            );

            // Интервалы
            // >=0-<=2
            // >2-<=6
            // >6-<=12
            // >12-<=15
            // >15-<=20
            // >20

            if($Time[$ItemKey] >= 0 && $Time[$ItemKey] <= 2 )
            {
                if(isset($Result[(int)$CurrentData[0]]['0-2'])) {
                    $Result[(int)$CurrentData[0]]['0-2']++;
                }else{
                    $Result[(int)$CurrentData[0]]['0-2'] = 1;
                }
            }

            // >2-<=6
            if($Time[$ItemKey] >2 && $Time[$ItemKey] <= 6 )
            {
                if(isset($Result[(int)$CurrentData[0]]['2-6'])) {
                    $Result[(int)$CurrentData[0]]['2-6']++;
                }else{
                    $Result[(int)$CurrentData[0]]['2-6'] = 1;
                }
            }

            // >6-<=12
            if($Time[$ItemKey] >6 && $Time[$ItemKey] <= 12)
            {
                if(isset($Result[(int)$CurrentData[0]]['6-12'])) {
                    $Result[(int)$CurrentData[0]]['6-12']++;
                }else{
                    $Result[(int)$CurrentData[0]]['6-12'] = 1;
                }
            }

            // >12-<=15
            if($Time[$ItemKey] >12 && $Time[$ItemKey] <= 15)
            {
                if( isset($Result[(int)$CurrentData[0]]['12-15']) ){
                    $Result[(int)$CurrentData[0]]['12-15']++;
                }else{
                    $Result[(int)$CurrentData[0]]['12-15'] = 1;
                }
            }

            // >15-<=20
            if($Time[$ItemKey] >15 && $Time[$ItemKey] <= 20 )
            {
                if( isset($Result[(int)$CurrentData[0]]['15-20']) ){
                    $Result[(int)$CurrentData[0]]['15-20']++;
                }else{
                    $Result[(int)$CurrentData[0]]['15-20'] = 1;
                }
            }

            // > 20
            if($Time[$ItemKey] > 20  )
            {
                if( isset($Result[(int)$CurrentData[0]]['20-..']) ){
                    $Result[(int)$CurrentData[0]]['20-..']++;
                }else{
                    $Result[(int)$CurrentData[0]]['20-..'] = 1;
                }
            }

            if(isset($Result[(int)$CurrentData[0]]['Count'])) {
                $Result[(int)$CurrentData[0]]['Count']++;
            }else{
                $Result[(int)$CurrentData[0]]['Count'] = 1;
            }

        }

        foreach($Result as &$Item){
            foreach($this->Winds() as $Wind){
                if(isset($Item[$Wind])) {
                    $Item[$Wind] = $Item[$Wind] / $Item['Count'];
                }else{
                    $Item[$Wind] = 0;
                }
            }
        }

//        echo '<meta charset="utf-8">';
////
//        print_r($Result);exit;
        return $Result;

    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get :: Velocity Times Year
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Get__Velocity_Times_Quarter($Data,$ItemKey)
    {
        $DateKey = 0;
        $Result = [];

        // To Array
        foreach($Data as $KeyTime => $Time)
        {

            // Date Format :: [0 => y, 1 => m, 2 => d]
            $CurrentData = array_reverse(
                explode( '.', substr($Time[$DateKey], 0, 10) )
            );

            if((int)$CurrentData[1] == 12 || (int)$CurrentData[1] == 1 || (int)$CurrentData[1] == 2){
                $CurrentData[1] = 1;
            }elseif((int)$CurrentData[1] == 3 || (int)$CurrentData[1] == 4 || (int)$CurrentData[1] == 5){
                $CurrentData[1] = 2;
            }elseif((int)$CurrentData[1] == 6 || (int)$CurrentData[1] == 7 || (int)$CurrentData[1] == 8){
                $CurrentData[1] = 3;
            }elseif((int)$CurrentData[1] == 9 || (int)$CurrentData[1] == 10 || (int)$CurrentData[1] == 11){
                $CurrentData[1] = 4;
            }

            // Интервалы
            // >=0-<=2
            // >2-<=6
            // >6-<=12
            // >12-<=15
            // >15-<=20
            // >20
            if($Time[$ItemKey] >= 0 && $Time[$ItemKey] <= 2 )
            {
                if(isset($Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['0-2'])) {
                    $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['0-2']++;
                }else{
                    $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['0-2'] = 1;
                }
            }

            // >2-<=6
            if($Time[$ItemKey] >2 && $Time[$ItemKey] <= 6 )
            {
                if(isset($Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['2-6'])) {
                    $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['2-6']++;
                }else{
                    $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['2-6'] = 1;
                }
            }

            // >6-<=12
            if($Time[$ItemKey] >6 && $Time[$ItemKey] <= 12)
            {
                if(isset($Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['6-12'])) {
                    $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['6-12']++;
                }else{
                    $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['6-12'] = 1;
                }
            }

            // >12-<=15
            if($Time[$ItemKey] >12 && $Time[$ItemKey] <= 15)
            {
                if( isset($Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['12-15']) ){
                    $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['12-15']++;
                }else{
                    $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['12-15'] = 1;
                }
            }

            // >15-<=20
            if($Time[$ItemKey] >15 && $Time[$ItemKey] <= 20 )
            {
                if( isset($Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['15-20']) ){
                    $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['15-20']++;
                }else{
                    $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['15-20'] = 1;
                }
            }

            // > 20
            if($Time[$ItemKey] > 20  )
            {
                if( isset($Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['20-..']) ){
                    $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['20-..']++;
                }else{
                    $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['20-..'] = 1;
                }
            }

            if(isset($Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['Count'])) {
                $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['Count']++;
            }else{
                $Result[(int)$CurrentData[0] . '-' . $CurrentData[1]]['Count'] = 1;
            }

        }

        foreach($Result as &$Item){
            foreach($this->Winds() as $Wind){
                if(isset($Item[$Wind])) {
                    $Item[$Wind] = $Item[$Wind] / $Item['Count'];
                }else{
                    $Item[$Wind] = 0;
                }
            }
        }
//        echo '<meta charset="utf-8">';
////
//        print_r($Result);exit;
        return $Result;

    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get :: Get Mode Direction For Each Hour :: Brief
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function GetModeDirectionForOutBrief($Data,$ItemKey)
    {
        $DateKey = 0;
        $Result = [];

        // To Array
        foreach($Data as $KeyTime => $Time)
        {
            $Replaces = [
                'Ветер, дующий с севера' =>                     'Пн',
                'Ветер, дующий с северо-северо-востока' =>      'ПнПнСх',
                'Ветер, дующий с северо-востока' =>             'ПнСх',
                'Ветер, дующий с востоко-северо-востока' =>     'СхПнСх',
                'Ветер, дующий с востока' =>                    'Сх',
                'Ветер, дующий с востоко-юго-востока' =>        'СхПдСх',
                'Ветер, дующий с юго-востока' =>                'ПдСх',
                'Ветер, дующий с юго-юго-востока' =>            'ПдПдСх',
                'Ветер, дующий с юга' =>                        'Пд',
                'Ветер, дующий с юго-юго-запада' =>             'ПдПдЗх',
                'Ветер, дующий с юго-запада' =>                 'ПдЗх',
                'Ветер, дующий с западо-юго-запада' =>          'ЗхПдЗх',
                'Ветер, дующий с запада' =>                     'Зх',
                'Ветер, дующий с западо-северо-запада' =>       'ЗхПнЗх',
                'Ветер, дующий с северо-запада' =>              'ПнЗх',
                'Ветер, дующий с северо-северо-запада' =>       'ПнПнЗх',
                'Штиль, безветрие' =>                           'Ш',
            ];


            foreach($Replaces as $ReplaceKey => $Replace)
            {
                $Time[$ItemKey] = str_replace($ReplaceKey, $Replace, $Time[$ItemKey]);
            }

            // Date Format :: [0 => y, 1 => m, 2 => d]
            $CurrentData = array_reverse(
                explode( '.', substr($Time[$DateKey], 0, 10) )
            );

            $CurrentTime = substr($Time[$DateKey], 11, 5);

            $Replaces = [
                '24:00' => '00:00',
                '01:00' => '00:00',
                '02:00' => '00:00',

                '04:00' => '03:00',
                '05:00' => '03:00',

                '07:00' => '06:00',
                '08:00' => '06:00',

                '10:00' => '09:00',
                '11:00' => '09:00',

                '13:00' => '12:00',
                '14:00' => '12:00',

                '16:00' => '15:00',
                '17:00' => '15:00',

                '19:00' => '18:00',
                '20:00' => '18:00',

                '22:00' => '21:00',
                '23:00' => '21:00'

            ];


            foreach($Replaces as $ReplaceKey => $Replace)
            {
                $CurrentTime = str_replace($ReplaceKey, $Replace, $CurrentTime);
            }



                $Result[(int)$CurrentData[1]][$CurrentTime][] = $Time[$ItemKey];

        }

        // Make Mode

        foreach($Result as $Key_2 => $Value_2){
            foreach($Value_2 as $Key_3 => $Value_3) {
                $Mode = [];
                foreach ($Value_3 as $ModeKey => $Item) {
                    if (empty($Mode[$Item])) {
                        $Mode[$Item] = 1;
                    } else {
                        $Mode[$Item]++;
                    }
                }

                $Mode = array_keys($Mode, max($Mode));
                $Result[$Key_2][$Key_3] = $Mode[0];
            }
        }

        ksort($Result);
        return $Result;
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get :: Wind Max-Capacity for Day
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function GetDayMaxCapacity($Data,$ItemKey)
{
    $DateKey = 0;
    $Result = [];

    // Each Time
    foreach($Data as $KeyTime => $Time)
    {

        // Date Format :: [0 => y, 1 => m, 2 => d]
        $CurrentData = array_reverse(
            explode( '.', substr($Time[$DateKey], 0, 10) )
        );

        // First Value
        $Result[(int)$CurrentData[0]][(int)$CurrentData[1]][(int)$CurrentData[2]][] = $Time[$ItemKey];
    }

    // Search Max
    foreach($Result as $Key_1 => $Value_1){
        foreach($Value_1 as $Key_2 => $Value_2){
            foreach($Value_2 as $Key_3 => $Value_3){
                $Result[$Key_1][$Key_2][$Key_3] = max($Value_3);
            }
        }
    }
    return $Result;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////









////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get :: Wind Max-Capacity for Month
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function GetMonthMaxCapacity($Data,$ItemKey)
{
    $DateKey = 0;
    $Result = [];

    // Each Time
    foreach($Data as $KeyTime => $Time)
    {

        // Date Format :: [0 => y, 1 => m, 2 => d]
        $CurrentData = array_reverse(
            explode( '.', substr($Time[$DateKey], 0, 10) )
        );
        $CurrentData[0] = (int)$CurrentData[0];
        $CurrentData[1] = (int)$CurrentData[1];


        // First Value
        $Result[$CurrentData[0]][$CurrentData[1]][] = $Time[$ItemKey];
    }

    // Search Max
    foreach($Result as $Key_1 => $Value_1){
        foreach($Value_1 as $Key_2 => $Value_2){
            $Result[$Key_1][$Key_2] = max($Value_2);
        }
    }
    return $Result;
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Get :: Month Wind-Speed for Month in Each Hour
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function GetSpeedEachHour($Data,$ItemKey)
    {
        $DateKey = 0;
        $Result = [];

        // To Array
            foreach($Data as $KeyTime => $Time)
            {

            // Date Format :: [0 => y, 1 => m, 2 => d]
            $CurrentData = array_reverse(
                explode( '.', substr($Time[$DateKey], 0, 10) )
            );

            $CurrentTime = substr($Time[$DateKey], 11, 5);

            $Replaces = [
                '24:00' => '00:00',
                '01:00' => '00:00',
                '02:00' => '00:00',

                '04:00' => '03:00',
                '05:00' => '03:00',

                '07:00' => '06:00',
                '08:00' => '06:00',

                '10:00' => '09:00',
                '11:00' => '09:00',

                '13:00' => '12:00',
                '14:00' => '12:00',

                '16:00' => '15:00',
                '17:00' => '15:00',

                '19:00' => '18:00',
                '20:00' => '18:00',

                '22:00' => '21:00',
                '23:00' => '21:00'

            ];


            foreach($Replaces as $ReplaceKey => $Replace)
            {
                $CurrentTime = str_replace($ReplaceKey, $Replace, $CurrentTime);
            }



            if( !isset($Result[(int)$CurrentData[0]][(int)$CurrentData[1]][$CurrentTime]['value']) )
            {
                $Result[(int)$CurrentData[0]][(int)$CurrentData[1]][$CurrentTime]['value'] = $Time[$ItemKey];
                $Result[(int)$CurrentData[0]][(int)$CurrentData[1]][$CurrentTime]['count'] = 1;
            }
            else
            {
                $Result[(int)$CurrentData[0]][(int)$CurrentData[1]][$CurrentTime]['value'] += $Time[$ItemKey];
                $Result[(int)$CurrentData[0]][(int)$CurrentData[1]][$CurrentTime]['count']++;
            }

        }

        // Make Mode
        foreach($Result as $Key_1 => $Value_1){
            foreach($Value_1 as $Key_2 => $Value_2){
                foreach($Value_2 as $Key_3 => $Value_3) {
                    $Result[$Key_1][$Key_2][$Key_3] = $Value_3['value']/$Value_3['count'];
                }
            }
        }

        return $Result;
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Directions(){
        $Directions = [
            'Пн',
            'ПнПнСх',
            'ПнСх',
            'СхПнСх',
            'Сх',
            'СхПдСх',
            'ПдСх',
            'ПдПдСх',
            'Пд',
            'ПдПдЗх',
            'ПдЗх',
            'ЗхПдЗх',
            'Зх',
            'ЗхПнЗх',
            'ПнЗх',
            'ПнПнЗх',
            'Ш',
        ];
        return $Directions;
    }

    public function Winds(){
        $Winds = [
            '0-2',
            '2-6',
            '6-12',
            '12-15',
            '15-20',
            '20-..',
        ];
        return $Winds;
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// CSV colons
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*
    [0] =>      "time";
    [1] =>      "temp";
    [2] =>      "pressureo";
    [3] =>      "pressure";
    [4] =>      "pressure_a";
    [5] =>      "wetness";
    [6] =>      "winddirection";
    [7] =>      "windvelocity";
    [8] =>      "ff10";
    [9] =>      "ff3";
    [10] =>     "N";
    [11] =>     "WW";
    [12] =>     "W1";
    [13] =>     "W2";
    [14] =>     "Tn";
    [15] =>     "Tx";
    [16] =>     "Cl";
    [17] =>     "Nh";
    [18] =>     "H";
    [19] =>     "Cm";
    [20] =>     "Ch";
    [21] =>     "VV";
    [22] =>     "Td";
    [23] =>     "RRR";
    [24] =>     "tR";
    [25] =>     "E";
    [25] =>     "E";
    [26] =>     "Tg";
    [27] =>     "E'";
    [28] =>     "sss";
*/

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}

