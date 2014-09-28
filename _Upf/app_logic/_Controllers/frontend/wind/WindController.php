<?php
namespace Controller\Frontend\WindSpace;

class WindController extends \Controller {
    /*
     usefully header
     "time";"temp";"pressureo";"pressure";"pressure_a";"wetness";"winddirection";"windvelocity";"ff10";"ff3";"N";"WW";"W1";"W2";"Tn";"Tx";"Cl";"Nh";"H";"Cm";"Ch";"VV";"Td";"RRR";"tR";"E";"Tg";"E'";"sss";
     * */

    public function index(){
        /***Parse csv file */

        $data = \Maatwebsite\Excel\Facades\Excel::selectSheets('time,temp')->load('/public/data/excel/file.csv', function($reader) {}, 'UTF-8')->toArray();
        $data = array_reverse((array)$data);

        /*** Вывод таблицы***/
        $viewData=[
            'avgDay'=>[
                'temp' => $this->getAvgDay($data,'temp'),
                'pressure' => $this->getAvgDay($data,'pressure'),
                'pressureo' => $this->getAvgDay($data,'pressureo'),
                'wind-velocity' => $this->getAvgDay($data,'windvelocity'),
                'wetness' => $this->getAvgDay($data,'wetness')
            ],
            'avgMonth'=>[
                'temp' => $this->getAvgMonth($data,'temp'),
                'pressure' => $this->getAvgMonth($data,'pressure'),
                'pressureo' => $this->getAvgMonth($data,'pressureo'),
                'wind-velocity' => $this->getAvgMonth($data,'windvelocity'),
                'wetness' => $this->getAvgMonth($data,'wetness')
            ]
        ];

        return \View::make('/frontend/site_wind/Main',$viewData);
    }



    public function getAvgDay($data,$key_set){
        /*** Среднесуточное значение ***/
        $prevData=false;
        $count_times=0.;
        $avgDay=[];
        $expPrevData=[];
        $expCurrentData=false;
        $expPrevData=false;

        foreach($data as $key=>$string){
            /* Дата::d.m.y */
            $currentData=substr($string['time'],0,10);
            $expCurrentData=explode('.',$currentData);

            /* Для первого элемента нельзя сделать +=*/
            if($key==0){
                $avgDay[$expCurrentData[2].'_'.$expCurrentData[1]][(int)$expCurrentData[0]]=$string[$key_set];
                $count_times++;
            }

            /* В текущей дате */
            if($currentData==$prevData){
                $avgDay[$expCurrentData[2].'_'.$expCurrentData[1]][(int)$expCurrentData[0]]+=$string[$key_set];
                $count_times++;
            }

            /* В следующей дате */
            if($currentData!=$prevData && $prevData){
                /*Разделить на количество показаний в сутки*/
                $count_times++;
                if($count_times){
                    $avgDay[$expPrevData[2].'_'.$expPrevData[1]][(int)$expPrevData[0]]=$avgDay[$expPrevData[2].'_'.$expPrevData[1]][(int)$expPrevData[0]]/$count_times;
                }
                $count_times=0;

                $avgDay[$expCurrentData[2].'_'.$expCurrentData[1]][(int)$expCurrentData[0]]=$string[$key_set];
            }

            /* Дата предыдущего цикла */
            $prevData=substr($string['time'],0,10);
            $expPrevData=explode('.',$prevData);
        }
        /* Для последнего значения */
        $count_times++;
        $avgDay[$expCurrentData[2].'_'.$expCurrentData[1]][(int)$expCurrentData[0]]=$avgDay[$expCurrentData[2].'_'.$expCurrentData[1]][(int)$expCurrentData[0]]/$count_times;

        ksort($avgDay);
        return $avgDay;
    }


    public function getAvgMonth($data,$key_set){
        /*** Среднемесячное значение ***/
        $prevData=false;
        $count_times=0.;
        $avgMonth=[];
        $expPrevData=[];
        $expCurrentData=false;
        $expPrevData=false;

        foreach($data as $key=>$string){
            /* Дата::d.m.y */
            $currentData=substr($string['time'],0,10);
            $expCurrentData=explode('.',$currentData);

            /* Для первого элемента нельзя сделать +=*/
            if($key==0){
                $avgMonth[$expCurrentData[2]][$expCurrentData[1]]=$string[$key_set];
                $count_times++;
            }

            /* В текущем месяце */
            if(!empty($expPrevData[1]) && ($expCurrentData[1].$expCurrentData[2])==($expPrevData[1].$expPrevData[2])){
                $avgMonth[$expCurrentData[2]][$expCurrentData[1]]+=$string[$key_set];
                $count_times++;
            }

            /* В следующем месяце */
            if(!empty($expPrevData[1]) && ($expCurrentData[1].$expCurrentData[2])!=($expPrevData[1].$expPrevData[2])){
                /*Разделить на количество показаний в сутки*/
                $count_times++;
                if($count_times){
                    $avgMonth[$expPrevData[2]][$expPrevData[1]]=$avgMonth[$expPrevData[2]][$expPrevData[1]]/$count_times;
                }
                $count_times=0;

                $avgMonth[$expCurrentData[2]][$expCurrentData[1]]=$string[$key_set];
            }

            /* Дата предыдущего цикла */
            $prevData=substr($string['time'],0,10);
            $expPrevData=explode('.',$prevData);
        }

        /* Для последнего значения */
        $count_times++;
        $avgMonth[$expCurrentData[2]][$expCurrentData[1]]=$avgMonth[$expCurrentData[2]][$expCurrentData[1]]/$count_times;

        ksort($avgMonth);
        return $avgMonth;
    }
}

