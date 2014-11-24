<?php

namespace Controller\Frontend\Excavator;

use SleepingOwl\Apist\Apist;

class ParserController extends \Controller
{

    public function ChangePhoto(){

    }

    // Todo :: Слетели фотки
    // Todo :: Козловые краны восстановить
    public function Index()
    {
        // Init ((до установки гнб(включительно)))
        $Parser = new Parser;
        echo '<meta charset="utf-8">';

        // Test Item
        $Catalog = new \UpfMigrations\Catalog();

//9,10,12,13,14,15,16
        for($I = 0;$I<40000;$I++){
            $Catalog = new \UpfModels\Catalog();
            if($Item = $Catalog->with('meta')->whereHas('meta',function($Query){
                    $Query->whereIn('category_id',[116]);
                })->where('id',$I)->first()){

                $Item->logotype = str_replace('http://exkavator.ru/','http://tehnoverh.ru/',$Item->logotype);
                echo $Item->logotype;
                $Item->save();
            }
        }
        exit;




//        print_r($Parser->Item_Model('/attachments/technic/abex_co_eexb120s'));
//        exit;

        // Get Links
        $Links = $Parser->List_Models();
        // Get Items
        foreach ($Links['links'] as $Key => $Link) {
            if ($Link && $Key>2692) {
                if ($Parsed = $Parser->Item_Model($Link['link'])) {
                    $Catalog->AddItem($Parsed);
                }
//                print_r($Key);
//                print_r($Link);
            }
        }


    }
}


class Parser extends Apist
{
    public $Class__Main = '.center_col ';

    public function getBaseUrl()
    {
        return 'http://maxi-exkavator.ru/';
    }

    public function Item_Model($Link = '')
    {

        return $this->get($Link,
            [
                'main'      => [
                    'title'    => Apist::filter($this->Class__Main . ' .norm>h2')->text(),
                    'intro'    => Apist::filter($this->Class__Main . ' .info')->text(),
                    'text'     => Apist::filter($this->Class__Main . ' .info')->text(),
                    'logotype' => Apist::filter($this->Class__Main . ' .img img')->attr('src'),
                ],
                'meta'      => [
                    'title'       => Apist::filter($this->Class__Main . ' .norm>h2')->text(),
                    'description' => Apist::filter($this->Class__Main . ' .info')->text(),
                    'keywords'    => Apist::filter($this->Class__Main . ' .info')->text(),
                    'alias'       => $Link,
                ],
                'relations' => [
                    'category' => Apist::filter($this->Class__Main . '.speedbar a:nth-of-type(3n)')->text(),
                    'producer' => Apist::filter($this->Class__Main . '.speedbar a:nth-of-type(4n)')->text(),
                    'params'   => Apist::filter($this->Class__Main . '.bnorm tr')->each([
                        'param' => [
                            'title' => Apist::filter('td:nth-of-type(1)')->text()->trim(),
                            'value' => Apist::filter('td:nth-of-type(2)')->text()->trim()
                        ]
                    ])
                ]
            ]);
    }


    public function List_Models()
    {
        return $this->get('/excapedia/technic/~?type=0&pr1=0&pr2=0&pr3=0&pr4=0&pr5=0&m1=&m2=&p=1&v=&x=67&y=7&Mode=1',
            [
                'links' => Apist::filter('.compare_veh td[valign=top] a')->each([
                    'link' => Apist::filter('*')->attr('href')
                ])
            ]);
    }
}