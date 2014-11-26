<?php

namespace Controller\Frontend\Excavator;

use SleepingOwl\Apist\Apist;

class ParserController extends \Controller
{
    /*
     * Parse Catalog
     */
    public function Index()
    {
        $Parser = new Parser;
        echo '<meta charset="utf-8">';
        $Companies = $Parser->List_Companies();
        foreach ($Companies['links'] as $CompanyKey => &$Company) {
            $Rent = str_replace('index', 'rent', $Company['link']);
            $Parts = str_replace('index', 'parts', $Company['link']);

//          $Company['rent'] = $Parser->List_Rate($Rent);
//          $Company['parts'] = $Parser->List_Parts($Parts);
            $Company['user'] = $Parser->Item_User($Company['link']);
            $Company['user']['main']['contacts'] = str_replace('  ','',$Company['user']['main']['contacts']);
            $Company['user']['main']['contacts'] = str_replace('</strong>','<strong>',$Company['user']['main']['contacts']);
            $Company['user']['main']['contacts'] = str_replace('\n','',$Company['user']['main']['contacts']);
            $Company['user']['main']['contacts'] = explode('<strong>',$Company['user']['main']['contacts']);
        }

        print_r($Companies);
    }


    public function ChangePhoto()
    {
        for ($I = 0; $I < 40000; $I++) {
            $Catalog = new \UpfModels\Catalog();
            if ($Item = $Catalog->with('meta')->whereHas('meta', function ($Query) {
                $Query->whereIn('category_id', [116]);
            })->where('id', $I)->first()
            ) {

                $Item->logotype = str_replace('http://exkavator.ru/', 'http://tehnoverh.ru/', $Item->logotype);
                echo $Item->logotype;
                $Item->save();
            }
        }
        exit;
    }


    public function IndexCatalog()
    {
        // Init ((до установки гнб(включительно)))
        $Parser = new Parser;
        echo '<meta charset="utf-8">';

        // Test Item
        $Catalog = new \UpfMigrations\Catalog();


//        print_r($Parser->Item_Model('/attachments/technic/abex_co_eexb120s'));
//        exit;

        // Get Links
        $Links = $Parser->List_Models();
        // Get Items
        foreach ($Links['links'] as $Key => $Link) {
            if ($Link && $Key > 2692) {
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
        return 'http://exkavator.ru/';
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



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Users
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function List_Companies()
    {
        $Data = [];
        for ($Page = 0; $Page < 20 /* 09280 */; $Page = $Page + 20) {
            $Data = array_merge_recursive((array)$Data,
                (array)$this->get('/trade/companies/find/pages/' . $Page,
                    [
                        'links' => Apist::filter('.b_prod')->each([
                            'link' => Apist::filter('h3>a')->attr('href')
                        ])
                    ])
            );
        }

        return $Data;
    }

    public function List_Rate($Link)
    {
        return $this->get($Link,
            [
                'links' => Apist::filter('.tablezebra tr')->each([
                    'link' => Apist::filter('.name a')->attr('href')
                ])
            ]);
    }

    public function List_Parts($Link)
    {
        return $this->get($Link,
            [
                'links' => Apist::filter('.tablezebra tr')->each([
                    'link' => Apist::filter('b a')->attr('href')
                ])
            ]);
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Item User
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Item_User($Link = '')
    {

        return $this->get($Link,
            [
                'main' => [
                    'title'    => Apist::filter('#centercol .norm>h1')->text(),
                    'intro'    => Apist::filter('#centercol .seller_item .info')->text(),
                    'text'     => Apist::filter('#centercol .seller_item .info')->text(),
                    'logotype' => Apist::filter('#centercol .seller_item .img .logo_item')->attr('src'),
                    'contacts' => Apist::filter('#centercol .ccontin')->html(),
                    'email' => Apist::filter('#centercol .ccontin>a')->attr('href'),
                ],
                'meta' => [
                    'title'       => Apist::filter('#centercol .norm>h1')->text(),
                    'description' => Apist::filter('#centercol .seller_item .info')->text(),
                    'keywords'    => Apist::filter('#centercol .seller_item .info')->text(),
                    'alias'       => $Link,
                ]
            ]);
    }
}