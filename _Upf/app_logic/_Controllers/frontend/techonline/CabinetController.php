<?php
namespace UpfFrontendControllers;

class CabinetController extends FrontendController{
    public $Model = '\UpfModels\Users';
    public $BaseUrl = '/cabinet/';
    public $View = '/general/layouts/Editing/';


    /******************************************************************************************************************* Cabinet Item ***/

        /*** Edit User Cabinet ***/

            public function Index(){
                /*** Default Model ***/
                $DefaultModel = new $this->Model();

                /*** Set Content ***/
                $this->ViewData['Content'] = $DefaultModel->EditItem($this->User['login'],true,'login');

                /*** Show View ***/
                return \View::make($this->View . 'Edit' , $this->ViewData);
            }




        /*** Update User Cabinet ***/

            public function Update(){
                /*** Default Model ***/
                $DefaultModel = new $this->Model();

                /*** Update Model ***/
                if($DefaultModel->UpdateItem( $this->User['login'],'login') ){
                    echo json_encode([ 'message'=>'Запись успешно обновлена.','type'=>'Success']);
                }else{
                    echo json_encode(['message'=>'Невозможно обновить запись.','type'=>'Error']);
                }
            }


    /******************************************************************************************************************* Cabinet Rent ***/

        /*** Edit user Cabinet ***/

            public function RentIndex(){
                /*** Default Model ***/
                $DefaultModel = new \UpfModels\Rent();

                /*** Set Content ***/
                $this->ViewData['Content'] = $DefaultModel->CabinetList($this->User['login']);

                /*** Show View ***/
                return \View::make($this->View . 'List' , $this->ViewData);
            }


    /*** Add Rent ***/

        public function RentAdd(){

            /*** Default Model ***/
            $DefaultModel = new \UpfModels\Rent();

            if( \Input::get('title')){
                /*** Save ***/
                if($Location = $DefaultModel->AddItem(true,$this->User['login'])){
                    echo json_encode(['message'=>'Запись успешно добавлена в базу данных.','type'=>'Success','location'=>$Location]);
                }else{
                    echo json_encode(['message'=>'Невозможно добавить запись.','type'=>'Error']);
                }
            }else{
                /*** Show Form ***/
                $this->ViewData['Content'] = [ 'Fields' => $DefaultModel->GetFields('add') ];

                return \View::make($this->View.'Add',$this->ViewData);
            }

        }


    /*** Show Edit Rent ***/

        public function RentEdit($Alias){

            $Model = new \UpfModels\Rent();

            $this->ViewData['Content'] = $Model->EditItem($Alias, true);

            return \View::make($this->View.'Edit',$this->ViewData);
        }


    /******************************************************************************************************************* Cabinet Rent ***/

    /*** Edit user Cabinet ***/

        public function PartsIndex(){
            /*** Default Model ***/
            $DefaultModel = new \UpfModels\Parts();

            /*** Set Content ***/
            $this->ViewData['Content'] = $DefaultModel->CabinetList($this->User['login']);

            /*** Show View ***/
            return \View::make($this->View . 'List' , $this->ViewData);
        }




    /*** Add Parts ***/
        public function PartsAdd(){

            /*** Default Model ***/
            $DefaultModel = new \UpfModels\Parts();

            if( \Input::get('title')){
                /*** Save ***/
                if($Location = $DefaultModel->AddItem(true,$this->User['login'])){
                    echo json_encode(['message'=>'Запись успешно добавлена в базу данных.','type'=>'Success','location'=>$Location]);
                }else{
                    echo json_encode(['message'=>'Невозможно добавить запись.','type'=>'Error']);
                }
            }else{
                /*** Show Form ***/
                $this->ViewData['Content'] = [ 'Fields' => $DefaultModel->GetFields('add') ];

                return \View::make($this->View.'Add',$this->ViewData);
            }

        }

    /*** Show Edit Parts ***/

        public function PartsEdit($Alias){

            $Model = new \UpfModels\Parts();

            $this->ViewData['Content'] = $Model->EditItem($Alias, true);

            return \View::make($this->View.'Edit',$this->ViewData);
        }


    /******************************************************************************************************************* Modules ***/
    public function Modules(){
        return [
            'Navigate' => [
                'Template' => $this->TemplateModules.'CabinetTabs',
                'Content' => ''
            ]
        ];
    }

}
