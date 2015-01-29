<?php
namespace UpfFrontendControllers;

class HomeController extends FrontendController
{
    public $View    = '/frontend/techonline/layouts/Home';
    public $Model   = '\UpfModels\Meta';
    public $BaseUrl = '/';


    public function __construct()
    {
        parent::__construct();

        // Set Filters
        $this->ViewData['HasFilters'] = [
            'Categories' => true,
            'Regions'    => true,
            'Tags'       => true,
            'Params'     => true,
            'Price'      => true,
            'TabsNode'   => 'Node-XXS-12 Node-XS-4'
        ];

    }

    public function Index()
    {
        /*** Default Model ***/
        $DefaultModel = new $this->Model();

        /*** Set Content ***/
        $this->ViewData['Content'] = $DefaultModel->FrontHome();

        return \View::make($this->View, $this->ViewData);
    }


    public function SiteMap()
    {
        $SiteMap = \App::make("sitemap");
        $SiteMap->setCache('laravel.sitemap', 36000);


        if (!$SiteMap->isCached()) {
            $SiteMap->add(\URL::to('/'), '2014-08-25T12:34:54+02:00', '1.0', 'daily');

            $SiteMap->add(\URL::to('/catalog'), date('Y-m-d'), '1.0', 'daily');
            $SiteMap->add(\URL::to('/rent'), date('Y-m-d'), '0.9', 'daily');
            $SiteMap->add(\URL::to('/parts'), date('Y-m-d'), '0.9', 'daily');
            $SiteMap->add(\URL::to('/users'), date('Y-m-d'), '0.8', 'daily');
            $SiteMap->add(\URL::to('/articles'), date('Y-m-d'), '0.8', 'daily');



            $SiteMap->add(\URL::to('/pages/instruction'), '2014-08-25T12:34:54+02:00', '1.0', 'daily');
            $SiteMap->add(\URL::to('/pages/contacts'), '2014-08-25T12:34:54+02:00', '1.0', 'daily');
            $SiteMap->add(\URL::to('/pages/about'), '2014-08-25T12:34:54+02:00', '0.9', 'daily');


            $Catalog = \UpfModels\Catalog::where('id', '<', '30000000')->with('meta')->get()->toArray();
            foreach ($Catalog as $Item) {
                $SiteMap->add(\URL::to('/catalog/' . $Item['meta']['alias']), $Item['meta']['updated_at'], '0.4', 'daily');
            }

            $Rent = \UpfModels\Rent::where('id', '<', '3000000')->with('meta')->get()->toArray();
            foreach ($Rent as $Item) {
                $SiteMap->add(\URL::to('/rent/' . $Item['meta']['alias']), $Item['meta']['updated_at'], '0.7', 'daily');
            }

            $Parts = \UpfModels\Parts::where('id', '<', '3000000')->with('meta')->get()->toArray();
            foreach ($Parts as $Item) {
                $SiteMap->add(\URL::to('/parts/' . $Item['meta']['alias']), $Item['meta']['updated_at'], '0.6', 'daily');
            }

            $Users = \UpfModels\Users::where('id', '<', '3000000')->with('meta')->get()->toArray();
            foreach ($Users as $Item) {
                $SiteMap->add(\URL::to('/users/' . $Item['meta']['alias']), $Item['meta']['updated_at'], '0.6', 'daily');
            }

            $Articles = \UpfModels\Articles::where('id', '<', '300000000')->with('meta')->get()->toArray();
            foreach ($Articles as $Item) {
                $SiteMap->add(\URL::to('/articles/' . $Item['meta']['alias']), $Item['meta']['updated_at'], '0.5', 'daily');
            }
        }
        return $SiteMap->render('xml');
    }

    public function Error()
    {
        return \View::make('/frontend/techonline/layouts/404', $this->ViewData);
    }

}
