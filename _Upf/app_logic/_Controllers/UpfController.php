<?php
namespace UpfControllers;

class UpfController extends \Controller{

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Variables :: Default
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public $ViewData = [];
public $Filters = [];
public $BaseUrl = '/';

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Variables :: Page Info
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public $Upf_Page_Interface =    'backend';
public $Upf_Page_Component =    '';
public $Upf_Page_Section =      '';
public $Upf_Page_Alias =        '';

public $Upf_Page_Action =       '';

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Constructor
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function __construct(){

    /**
     * Render Data From     ::     $Upf_Page_Interface
     *
     * VIEW                 ::     $Upf[Page][Interface]    =     value
     */


    $this->ViewData['Upf']['Page'] = [
        'Interface' =>   $this->Upf_Page_Interface,
        'Component' =>   $this->Upf_Page_Component,
        'Section'   =>   $this->Upf_Page_Section,
        'Alias'     =>   $this->Upf_Page_Alias,
        'Action'    =>   $this->Upf_Page_Action,
        'BaseUrl'    =>   $this->BaseUrl,
    ];


}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}

