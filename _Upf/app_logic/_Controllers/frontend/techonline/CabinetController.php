<?php
namespace UpfFrontendControllers;


class CabinetController extends SystemController{
    public $Upf_Page_Section = 'cabinet';

    public $Model = '\UpfModels\Users';
    public $BaseUrl = '/cabinet/';
    public $View = '/general/layouts/Editing/';


    /******************************************************************************************************************* Cabinet Item ***/


    /*** Edit User Cabinet ***/

        public function Index(){
            /*** Default Model ***/
            $DefaultModel = new $this->Model();

            /*** Set Content ***/
            $this->ViewData['Content'] = $DefaultModel->FrontendItem($this->User['login'],false,'login');



            /*** Show View ***/
            return \View::make('/frontend/techonline/layouts/Snippet/Edit' , $this->ViewData);
        }


        /*** Edit User Cabinet ***/

            public function Profile(){
                /*** Default Model ***/
                $DefaultModel = new $this->Model();

                /*** Set Content ***/
                $this->ViewData['Content'] = $DefaultModel->EditItem($this->User['login'],true,'login','frontend');

                /*** Show View ***/
                return \View::make($this->View . 'Edit' , $this->ViewData);
            }




        /*** Update User Cabinet ***/

            public function ProfileUpdate(){
                /*** Default Model ***/
                $DefaultModel = new $this->Model();

                /*** Update Model ***/
                if($DefaultModel->UpdateItem( $this->User['login'], true, 'login') ){
                    echo json_encode([ 'message'=>'Запись успешно обновлена.','type'=>'Success']);
                }else{
                    echo json_encode(['message'=>'Невозможно обновить запись.','type'=>'Error']);
                }
            }


        /*** Update Cabinet Photos ***/

        public function ProfilePhotos(){

            $Model = new $this->Model();

            if($Files = $Model->UpdateItemPhotos($this->User['login'], true, 'login')){
                echo json_encode(['message' => 'Запись успешно обновлена.','type'=>'Success','files'=>$Files]);
            }else{
                echo json_encode(['message' => 'Невозможно обновить запись.','type'=>'Error']);
            }
        }



        /*** Remove Cabinet Logotype ***/

        public function RemoveProfileLogotype(){

            $Model = new $this->Model();

            if($Model->RemoveLogotype($this->User['login'], true,'login')){
                echo json_encode([ 'message'=>'Фото успешно обновлена.','type'=>'Success']);
            }else{
                echo json_encode(['message'=>'Невозможно удалить Фото.','type'=>'Error']);
            }
        }





        /*** Remove Cabinet Photos ***/

        public function RemoveProfilePhotos($Id){

            $Model = new $this->Model();

            if($Updated=$Model->RemovePhoto($this->User['login'], $Id, true,'login')){
                echo json_encode([ 'message'=>'Фото успешно обновлена.','type'=>'Success']);
            }else{
                echo json_encode(['message'=>'Невозможно удалить Фото.','type'=>'Error']);
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

                $this->ViewData['Content'] = $Model->EditItem($Alias, true, false,'frontend');

                return \View::make($this->View.'Edit',$this->ViewData);
            }


    /*** Update User Rent ***/

    public function RentUpdate($Alias){
        /*** Default Model ***/
        $DefaultModel = new \UpfModels\Rent();

        /*** Update Model ***/
        if($DefaultModel->UpdateItem( $Alias, true ) ){
            echo json_encode([ 'message'=>'Запись успешно обновлена.','type'=>'Success']);
        }else{
            echo json_encode(['message'=>'Невозможно обновить запись.','type'=>'Error']);
        }
    }


    /*** Remove Rent Item ***/
    public function RentRemove($Alias){

        $DefaultModel = new \UpfModels\Rent();

        if($DefaultModel->remove($Alias, true)){
            echo json_encode(['message'=>'Запись успешноудалена из базы данных.','type'=>'Success']);
        }else{
            echo json_encode(['message'=>'Невозможно удалить запись.','type'=>'Error']);
        }
    }


    /*** Update Rent Photos ***/

    public function RentPhotos($Alias){

        $DefaultModel = new \UpfModels\Rent();

        if($Files = $DefaultModel->UpdateItemPhotos($Alias, true)){
            echo json_encode(['message' => 'Запись успешно обновлена.','type'=>'Success','files'=>$Files]);
        }else{
            echo json_encode(['message' => 'Невозможно обновить запись.','type'=>'Error']);
        }
    }



    /*** Remove Rent Logotype ***/

    public function RentRemoveLogotype($Alias){

        $DefaultModel = new \UpfModels\Rent();

        if($DefaultModel->RemoveLogotype($Alias, true)){
            echo json_encode([ 'message'=>'Фото успешно обновлена.','type'=>'Success']);
        }else{
            echo json_encode(['message'=>'Невозможно удалить Фото.','type'=>'Error']);
        }
    }





    /*** Remove Rent Photos ***/

    public function RentRemovePhotos($Alias,$Id){

        $DefaultModel = new \UpfModels\Rent();

        if($Updated=$DefaultModel->RemovePhoto($Alias, true, $Id, true)){
            echo json_encode([ 'message'=>'Фото успешно обновлена.','type'=>'Success']);
        }else{
            echo json_encode(['message'=>'Невозможно удалить Фото.','type'=>'Error']);
        }
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

            $this->ViewData['Content'] = $Model->EditItem($Alias, true, false,'frontend');

            return \View::make($this->View.'Edit',$this->ViewData);
        }


    /*** Update User Parts ***/

    public function PartsUpdate($Alias){
        /*** Default Model ***/
        $DefaultModel = new \UpfModels\Parts();

        /*** Update Model ***/
        if($DefaultModel->UpdateItem( $Alias, true ) ){
            echo json_encode([ 'message'=>'Запись успешно обновлена.','type'=>'Success']);
        }else{
            echo json_encode(['message'=>'Невозможно обновить запись.','type'=>'Error']);
        }
    }


    /*** Remove Rent Item ***/
    public function PartsRemove($Alias){

        $DefaultModel = new \UpfModels\Parts();

        if($DefaultModel->remove($Alias, true)){
            echo json_encode(['message'=>'Запись успешноудалена из базы данных.','type'=>'Success']);
        }else{
            echo json_encode(['message'=>'Невозможно удалить запись.','type'=>'Error']);
        }
    }


    /*** Update Rent Photos ***/

    public function PartsPhotos($Alias){

        $DefaultModel = new \UpfModels\Parts();

        if($Files = $DefaultModel->UpdateItemPhotos($Alias, true)){
            echo json_encode(['message' => 'Запись успешно обновлена.','type'=>'Success','files'=>$Files]);
        }else{
            echo json_encode(['message' => 'Невозможно обновить запись.','type'=>'Error']);
        }
    }



    /*** Remove Rent Logotype ***/

    public function PartsRemoveLogotype($Alias){

        $DefaultModel = new \UpfModels\Parts();

        if($DefaultModel->RemoveLogotype($Alias, true)){
            echo json_encode([ 'message'=>'Фото успешно обновлена.','type'=>'Success']);
        }else{
            echo json_encode(['message'=>'Невозможно удалить Фото.','type'=>'Error']);
        }
    }





    /*** Remove Rent Photos ***/

    public function PartsRemovePhotos($Alias,$Id){

        $DefaultModel = new \UpfModels\Parts();

        if($Updated=$DefaultModel->RemovePhoto($Alias, true, $Id, true)){
            echo json_encode([ 'message'=>'Фото успешно обновлена.','type'=>'Success']);
        }else{
            echo json_encode(['message'=>'Невозможно удалить Фото.','type'=>'Error']);
        }
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
