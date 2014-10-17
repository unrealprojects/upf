<?php
namespace UpfControllers;

class UpfController extends \Controller{

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Variables :: Default
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public $ViewData = [];

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Variables :: Global
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public $Upf =            'Upf';
    public $Upf_Page =       '';
    public $Upf_Start =      '';

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Variables :: Page
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public $Upf_Page_Interface =    'backend';
public $Upf_Page_Component =    'sections';
public $Upf_Page_Section =      'articles';
public $Upf_Page_Alias =        '';

public $Upf_Page_Type =         'home';

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Constructor
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
public function __construct(){

    /**
     * Render Data From     ::     $Upf_Page_Interface
     *
     * SCSS                 ::     @Upf_Page_Interface:     value;
     * JS                   ::     Upf.Page.Interface =     value;
     * VIEW                 ::     $Upf[Page][Interface]=     value
     */
/*
    $Js_Fields =      'var ' . $this->Upf . ";\n";
    $Scss_Fields =    '';

    foreach( get_object_vars($this) as $Field_Key => $Field_Value )
    {

        $Bits = explode('_',$Field_Key);


        if($Bits[0] == 'Upf' && count($Bits)>1 )
        {

            // Write Js

            // Like " Upf.Page.Interface = 'backend'; "
            if($Field_Value != '')
            {
                $Js_Fields .=  implode('.', $Bits) . ' = \'' . $Field_Value . '\'' . ";\n";
            }
            // Like " Upf.Page = '{}'; "
            else
            {
                $Js_Fields .=  implode('.', $Bits) . ' = {}' . ";\n";
            }


            // Like " Upf-Page-Interface "
            if($Field_Value != '')
            {
                $Scss_Fields .= '$' . implode('-', $Bits) . ' = ' . $Field_Value . ';\n';
            }


            // Write ViewData
            if($Field_Value != ''){
                foreach($Bits as $Bit_Key => $Bit_Value){
                    if($Bit_Key>0){
                        $Array_Key[$Bit_Value] = $Bits;
                    }
                }
            }

        }
    }

   // \File::put(base_path() . '/public/js/general/upf/Core/Variables.js', $Js_Fields); // Style
    \File::put(base_path() . '/public/scss/upf.js', $Js_Fields);

    exit;
*/
}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


}

